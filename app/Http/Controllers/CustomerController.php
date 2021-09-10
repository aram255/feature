<?php

namespace App\Http\Controllers;

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use App\Models\Card;
use App\Models\CustomerModel;
use App\Models\ServiceDescriptionModel;
use App\Models\ServiceSessionModel;
use App\Models\ServicesModel;
use App\Models\TypeFormModel;
use App\Models\FavoriteModel;
use App\Models\ProtocolAnotherModel;
use App\Models\ZoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use File;
use Hash;
use DB;



class CustomerController extends Controller
{
    public function __construct()
    {

         $this->middleware('auth');
    }
    public function profileCustomer()
    {



      //  $t1 = strtotime($InProcessVal->create);
//        $t2 = strtotime( '2006-04-14 12:30:00' );
//        $diff = $t2 - $t1;
//        echo $hours = $diff / ( 60 * 60 );

        $InProcess = DB::table('practitioner')
                     ->select('practitioner.id','practitioner.img','practitioner.first_name','practitioner.last_name','practitioner.email','practitioner.phone_number',
                         'zoom_meetings_list.start','zoom_meetings_list.duration','zoom_meetings_list.password','zoom_meetings_list.join_url',
                         'services.title as service_name','zoom_meetings_list.service_id','type_form_practitioner.id as type_form_id','zoom_meetings_list.create')
                     ->join('zoom_meetings_list', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
                     ->join('type_form_practitioner', 'practitioner.id', 'type_form_practitioner.practitioner_id')
                     ->join('services', 'services.id', 'zoom_meetings_list.service_id')
                     ->where('zoom_meetings_list.user_id',Auth::id())
                     ->where('type_form_practitioner.defaultt',1)
                     ->whereDate("zoom_meetings_list.start", ">=",date('Y-m-d'))
                     ->orderBy('zoom_meetings_list.id','DESC')
                     ->paginate(5);

//       dd($InProcess);


        $Review = DB::table('reviews')
                  ->select('reviews.rate','reviews.description','practitioner.last_name','practitioner.first_name','practitioner.img','reviews.created_at')
                  ->join('practitioner', 'practitioner.id', 'reviews.practitoner_id')
                  ->where('reviews.user_id',Auth::id())
                  ->get();


//        $PractitionerFavorite =  DB::table('practitioner')
//                                ->select('practitioner.first_name','practitioner.last_name','practitioner.description','practitioner.video','practitioner.img','favorite.practitioner_id','practitioner.id as partit_id','practitioner.email','practitioner.phone_number','zoom_meetings_list.password','zoom_meetings_list.duration','zoom_meetings_list.join_url','zoom_meetings_list.service_id','zoom_meetings_list.create')
//                                ->join('favorite', 'practitioner.id', 'favorite.practitioner_id')
//                                ->join('zoom_meetings_list', 'favorite.user_id', 'zoom_meetings_list.user_id')
//                                ->where('favorite.user_id',Auth::id())
//                                ->get();
        $PractitionerFavorite =  DB::table('practitioner')
                                ->select('practitioner.first_name','practitioner.last_name','practitioner.description','practitioner.video','practitioner.img','favorite.practitioner_id','practitioner.id as partit_id','practitioner.email','practitioner.phone_number')
                                ->join('favorite', 'practitioner.id', 'favorite.practitioner_id')
                                ->where('favorite.user_id',Auth::id())
                                ->get();

//       dd($PractitionerFavorite);

        $Teg = DB::table('teg_managements')
               ->join('practitioner_teg_managements', 'teg_managements.id', 'practitioner_teg_managements.teg_managements_id')
               ->where('teg_managements.published',1)
               ->get();

        $Service  =  ServicesModel::all();
        $ServiceSession = ServiceSessionModel::all();
        $ServiceDescription = ServiceDescriptionModel::all();

        $title =[];
        $price =[];
        $ID =[];
        foreach ($Service as $serviceV)
        {
            $title[] =  $serviceV->title;
            $price[] =  $serviceV->price;
            $ID[]    =  $serviceV->id;
        }

        $ServiceSession=[];

        foreach ($ID as $PrId)
        {
            $ServiceSession[] = ServiceSessionModel::where('services_id',$PrId)->get();
        }

        $ServiceDescription=[];

        foreach ($ID as $PrID)
        {
            $ServiceDescription[] = ServiceDescriptionModel::where('services_id',$PrID)->get();
        }


        return view('profile-customer',compact('InProcess','Review','PractitionerFavorite','Teg','Service','ServiceSession','ServiceDescription'));
    }

    public function typeFormPractitionerView($lang,$id)
    {
        $TypeFormView = TypeFormModel::find($id);

        return view('type-form-view',compact('TypeFormView'));
    }

    public  function editProfileCustomer()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('edit-profile-customer', compact('cards'));
    }

    public function editProfileCustmerPost(request $request)
    {
//        $request->validate([
//            "password" => 'required|confirmed|min:6'
//        ]);

       //dd($request->gender);
        $EditCustomer = CustomerModel::where('id',Auth::id())->first();

        if(!empty($request->file('img')))
        {
            $ImgName     = rand() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('web_sayt/img_customer/'), $ImgName);

            if(File::exists(public_path('web_sayt/img_customer/'.$EditCustomer->img))){
                File::delete(public_path('web_sayt/img_customer/'.$EditCustomer->img));
            }

            $EditCustomer->img       = $ImgName;
            $EditCustomer->first_name = $request->first_name;
            $EditCustomer->last_name = $request->last_name;
            $EditCustomer->phone_number = $request->phone_number;
            $EditCustomer->email = $request->email;
            if($EditCustomer && in_array($request->gender,array('Male','Famale','Other'))) {
            $EditCustomer->gender = $request->gender;
            }
        }else{
            $EditCustomer->first_name = $request->first_name;
            $EditCustomer->last_name = $request->last_name;
            $EditCustomer->phone_number = $request->phone_number;
            $EditCustomer->email = $request->email;
            if($EditCustomer && in_array($request->gender,array('Male','Famale','Other'))) {
                $EditCustomer->gender = $request->gender;
            }
        }

        $EditCustomer->save();

        if($request->password != null) {
            $EditCustomerPassword = CustomerModel::where('id', Auth::id())->first();

//            if (Hash::check($request->password, $EditCustomerPassword->password))
//            {

                if (Hash::check($request->password, Hash::make($request->password_confirmation)))
                {

                    $request->validate([
                        "password"              => 'required',
                        "password_confirmation" => 'required'
                    ]);

                    $EditCustomerPassword->password = Hash::make($request->password);
                    $EditCustomerPassword->save();

                    if(!empty($EditCustomerPassword))
                    {
                        return back()->with('status','Your request has been completed.');
                    }
                }

            }
      //  }
        if(!empty($EditCustomer))
        {
            return back()->with('status','Your request has been completed');
        }

    }

    public function profileViewCustomer()
    {
        return view('profile-view-as-a-customer');
    }

    public function addFavorite(request $request)
    {
        if(!empty($request->type) and $request->type == 'add')
        {

          $Add = new FavoriteModel;
          $Add->practitioner_id = $request->practitioner_id;
          $Add->user_id = Auth::id();
          $Add->save();

            return response()->json($Add);

        }

        if(!empty($request->type) and $request->type == 'delete')
        {
            $DeleteFavorite = FavoriteModel::where('practitioner_id',$request->practitioner_id)->where('user_id',Auth::id())->first();
            $DeleteFavorite->delete();

            return response()->json($DeleteFavorite);
        }

    }

    public function myAppointmentsCustomer(request $request,$lang,$id)
    {

        //  dd(date('Y-m-d H:i:s'));

        $InProcess = DB::table('practitioner')
            ->join('zoom_meetings_list', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
            ->where('zoom_meetings_list.user_id',Auth::id())
            ->whereDate("zoom_meetings_list.start", ">=",date('Y-m-d'))
            ->orderBy('zoom_meetings_list.id','DESC')
            ->paginate(5);


        $TypeForm = DB::table('type_form_practitioner')->where('defaultt',1)->get();




        $Complete  = DB::table('practitioner')
            ->join('zoom_meetings_list', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
            ->where('zoom_meetings_list.user_id',Auth::id())
            ->whereDate("zoom_meetings_list.start", "<=",date('Y-m-d'))
            ->orderBy('zoom_meetings_list.id','DESC')
            ->paginate(5);


        $StatusProtocol = DB::table('protocol_heading')->where('user_id',Auth::id())->get();

//        $a  = Carbon::now()->add('2021-08-27');
//        dd($a);
//        $dateTime = date('m/d/Y');
//        $h =  Carbon::createFromFormat('Y-m-d', $dateTime)->format('m/d/Y');
        Carbon::createFromFormat('m/d/Y', '08/31/2021')->format('m/d/Y');


//        $now = Carbon::now();
//        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
//        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
//
//
//        $a  =  $weekStartDate - $weekEndDate;
//
//        dd($a);

//        $current_week = ZoomModel::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
//        dd($current_week);

        function week_between_two_dates($date1, $date2)
        {
            $first = DateTime::createFromFormat('m/d/Y', $date1);
            $second = DateTime::createFromFormat('m/d/Y', $date2);
            if($date1 > $date2) return week_between_two_dates($date2, $date1);
            return floor($first->diff($second)->days/7);
        }

        $StartDate = Carbon::createFromFormat('m/d/Y', '08/31/2021')->format('m/d/Y');
        $LiveDate = Carbon::now()->format('m/d/Y');
        week_between_two_dates($StartDate, $LiveDate);


        return view('my-appointments-customer',compact('InProcess','Complete','id','StatusProtocol','TypeForm'));
    }

      public  function week_between_two_dates($date1, $date2)
      {
            $first = DateTime::createFromFormat('m/d/Y', $date1);
            $second = DateTime::createFromFormat('m/d/Y', $date2);
            if($date1 > $date2) return week_between_two_dates($date2, $date1);
            return floor($first->diff($second)->days/7);
      }

    public function ViewProtocol($lang,$serviceID,$userID,$practitionerID)
    {

        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->get();
        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->get();
        $ProtocolLink    = DB::table('protocol_link')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->get();
        $ProtocolAnother = DB::table('protocol_another')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->get();
        $Services = ServicesModel::where('id',$serviceID)->where('practitioner_id',$practitionerID)->first();

        $CheckWeek = ZoomModel::where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('user_id',Auth::id())->first();

        // Get Week count
        $StartDate = Carbon::createFromFormat('Y-m-d H:i:s', $CheckWeek->start)->format('m/d/Y');
        $LiveDate = Carbon::now()->format('m/d/Y');
        $Week =  $this->week_between_two_dates($StartDate, $LiveDate);

        $ProtocolCheckSelected = DB::table('protocol_another')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->whereNull('selected')->get();

        $CheckCountSelected = count($ProtocolCheckSelected);




        $GetProtocol   = DB::table('protocol_heading')
            ->select('service_id','user_id')
            ->where('practitioner_id',$practitionerID)
            ->groupBy('service_id','user_id')
            ->get();

        $Practitioner = DB::table('practitioner')->where('id',$practitionerID)->first();



        return view('protocol-view-customer',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','GetProtocol','ProtocolAnother','Services','Week','CheckCountSelected','Practitioner'));
    }

    public function addSelectProtocol(request $request, $lang,$practitionerID,$serviceID)
    {

        foreach ($request->another_id as $key => $value) {

            if (isset($request->another[$key])) {
                $Edit = DB::table('protocol_another')->where('service_id', $serviceID)->where('user_id', Auth::id())->where('practitioner_id', $practitionerID)->where('id', $value)->update(['selected' => $request->another[$key]]);
            } else {
                $Edit = DB::table('protocol_another')->where('service_id', $serviceID)->where('user_id', Auth::id())->where('practitioner_id', $practitionerID)->where('id', $request->another_id[$key])->update(['selected' => 'no']);
            }
        }

        return back()->with('status','Your request has been completed.');


    }
}
