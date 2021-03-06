<?php

namespace App\Http\Controllers;

use App\Models\User;
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
use App\Models\ReviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use File;
use Hash;
use DB;

use Validator,Redirect,Response;
//use DateTime;
use DateTimeZone;



class CustomerController extends Controller
{
    public function __construct()
    {
        include  base_path("vendor/autoload.php");
        $this->middleware('auth');
    }
    public function profileCustomer()
    {


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




        $Review = DB::table('reviews')
            ->select('reviews.rate','reviews.description','practitioner.last_name','practitioner.first_name','practitioner.img','reviews.created_at','reviews.practitoner_id')
            ->join('practitioner', 'practitioner.id', 'reviews.practitoner_id')
            ->where('reviews.user_id',Auth::id())
            ->where('reviews.description','!=',null)
            ->get();

        $SpecialitiesReview = [];
        foreach ($Review as $ReviewVal)
        {
            $SpecialitiesReview[] = DB::table('specialities')
                                      ->join('practitioner_specialities','practitioner_specialities.specialities_id', 'specialities.id')
                                      ->where('specialities.published', '=', 1)
                                      ->where('practitioner_specialities.practitioner_id','=', $ReviewVal->practitoner_id)
                                      ->get();
        }


        $PractitionerFavorite =  DB::table('practitioner')
            ->select('practitioner.first_name','practitioner.last_name','practitioner.description','practitioner.video','practitioner.img','favorite.practitioner_id','practitioner.id as partit_id','practitioner.email','practitioner.phone_number','practitioner.lat','practitioner.lng','practitioner.location')
            ->join('favorite', 'practitioner.id', 'favorite.practitioner_id')
            ->where('favorite.user_id',Auth::id())
            ->get();


        $SpecialitiesFavorite = [];
        $Rate = [];
        $SessionCountFavorite = [];

        foreach ($PractitionerFavorite as $ValRate)
        {
            $Rate[] = DB::table('reviews')
                ->select('reviews.rate','reviews.description','users.last_name','users.first_name','users.img','reviews.created_at')
                ->join('users', 'users.id', 'reviews.user_id')
                ->where('reviews.practitoner_id',$ValRate->practitioner_id)
                ->where('reviews.user_id',Auth::id())
                ->avg('rate');

            $SpecialitiesFavorite[] = DB::table('specialities')
                                      ->join('practitioner_specialities','practitioner_specialities.specialities_id', 'specialities.id')
                                      ->where('specialities.published', '=', 1)
                                      ->where('practitioner_specialities.practitioner_id','=', $ValRate->practitioner_id)
                                      ->get();

            $SessionCountFavorite[]  = DB::table('users')
                                     ->join('zoom_meetings_list', 'users.id', 'zoom_meetings_list.user_id')
                                     ->where('zoom_meetings_list.practitioner_id',$ValRate->practitioner_id)
                                     ->whereDate("zoom_meetings_list.start", "<=",date('Y-m-d H:i:s'))
                                     ->count();
        }




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


        return view('profile-customer',compact('InProcess','Review','PractitionerFavorite','Teg','Service','ServiceSession','ServiceDescription','Rate','SpecialitiesFavorite','SpecialitiesReview','SessionCountFavorite'));
    }


    public function typeFormPractitionerView($lang,$id,$meetingID)
    {
        $TypeFormView = TypeFormModel::find($id);

        return view('type-form-view',compact('TypeFormView'));
    }

    public function editTypeForm(request $request)
    {

          DB::table('zoom_meetings_list')->where('id',$request->meetingID)->update(['check_type_form' => $request->responseID]);

        return response()->json(['yes' => 'Your request has been made.','no' => 'Your request has not been processed.']);

    }

    public  function editProfileCustomer()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('edit-profile-customer', compact('cards'));
    }

    public function editProfileCustmerPost(request $request)
    {

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
            $EditCustomer->api_key = $request->api_key;
            $EditCustomer->api_secret = $request->secret_key;
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
            $EditCustomer->api_key = $request->api_key;
            $EditCustomer->api_secret = $request->secret_key;
        }

        $EditCustomer->save();

        if($request->password != null) {
            $EditCustomerPassword = CustomerModel::where('id', Auth::id())->first();



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



    public function myAppointmentsCustomer(request $request,$lang,$id,$practitionrers = null,$service_name = null,$date_time = null,$price = null)
    {


        $InProcess = DB::table('practitioner')
            ->join('zoom_meetings_list', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
            ->where('zoom_meetings_list.user_id',Auth::id())
            ->whereDate("zoom_meetings_list.start", ">=",date('Y-m-d H:i:s'))
            ->orderBy('zoom_meetings_list.id','DESC')
            ->paginate(5);

        $SpecialitiesInProcess = [];

        foreach ($InProcess as $InProcessVal)
        {
            $SpecialitiesInProcess[] = DB::table('specialities')
                                       ->join('practitioner_specialities','practitioner_specialities.specialities_id', 'specialities.id')
                                       ->where('specialities.published', '=', 1)
                                       ->where('practitioner_specialities.practitioner_id','=', $InProcessVal->practitioner_id)
                                       ->get();
        }



        $TypeForm = DB::table('type_form_practitioner')->where('defaultt',1)->get();


        $h = [];
        if (count($InProcess)!=0) {

            $client = new \GuzzleHttp\Client();

            foreach ($InProcess as $valP) {

                $TypeFormm = DB::table('type_form_practitioner')->where('defaultt', 1)->where('practitioner_id', $valP->practitioner_id)->first();

                $response = $client->request('GET', 'https://api.typeform.com/forms/' . $TypeFormm->url . '/responses', [
                    "headers" => [
                        "Authorization" => "Bearer " . $valP->personal_token_typeform
                    ]
                ]);

                $data = json_decode($response->getBody());

                $response_id = [];
                foreach ($data->items as $Key => $valResponseID) {
                    $response_id[] = $valResponseID->response_id;
                }

                $Progres[] = $valP->check_type_form;
            }

        }

        $CheckTypeForm = [];
        if (count($InProcess)!=0) {
            foreach ($Progres as $k => $vk) {
                $CheckTypeForm[] = array_search($vk, $response_id);
            }
        }




        $Complete  = DB::table('practitioner')
                    ->join('zoom_meetings_list', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
                    ->where('zoom_meetings_list.user_id',Auth::id())
                    // ->whereDate("zoom_meetings_list.start", "<=",$dt->format('Y-m-d H:i:s'))
                    ->whereDate("zoom_meetings_list.start", "<=",date('Y-m-d H:i:s'))
                    ->orderBy('zoom_meetings_list.id','DESC')
                    ->paginate(5);



        $ReviewRate = [];
        $SpecialitiesComplete = [];

        foreach ($Complete as $CompleteVal)
        {

            $ReviewRate[] = DB::table('reviews')

                ->where('user_id',Auth::id())
                ->where('practitoner_id',$CompleteVal->practitioner_id)
                ->where('meeting_id',$CompleteVal->id)
                ->first();

            $SpecialitiesComplete[] = DB::table('specialities')
                                      ->join('practitioner_specialities','practitioner_specialities.specialities_id', 'specialities.id')
                                      ->where('specialities.published', '=', 1)
                                      ->where('practitioner_specialities.practitioner_id','=', $CompleteVal->practitioner_id)
                                      ->get();
        }



        $StatusProtocol = DB::table('protocol_heading')->where('user_id',Auth::id())->get();

        Carbon::createFromFormat('m/d/Y', '08/31/2021')->format('m/d/Y');


        function week_between_two_dates($date1, $date2)
        {
            $first = DateTime::createFromFormat('m/d/Y', $date1);
            $second = DateTime::createFromFormat('m/d/Y', $date2);
            if($date1 > $date2) return week_between_two_dates($date2, $date1);
            return floor($first->diff($second)->days/7);
        }

        $StartDate = Carbon::createFromFormat('m/d/Y', '08/31/2021')->format('m/d/Y');
        $LiveDate = Carbon::now()->format('m/d/Y');

        return view('my-appointments-customer',compact('InProcess','Complete','id','StatusProtocol','TypeForm','CheckTypeForm','ReviewRate','SpecialitiesComplete','SpecialitiesInProcess'));
    }

    public  function week_between_two_dates($date1, $date2)
    {
        $first = DateTime::createFromFormat('m/d/Y', $date1);
        $second = DateTime::createFromFormat('m/d/Y', $date2);
       // if($date1 > $date2) return week_between_two_dates($date2, $date1);
        return floor($first->diff($second)->days/7);
    }

    public function ViewProtocol($lang,$serviceID,$userID,$practitionerID,$meetingID)
    {

        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolLink    = DB::table('protocol_link')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolAnother = DB::table('protocol_another')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $Services = ServicesModel::where('id',$serviceID)->where('practitioner_id',$practitionerID)->first();

        $CheckWeek = ZoomModel::where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('id',$meetingID)->where('user_id',Auth::id())->first();

        // Get Week count
        $StartDate = Carbon::createFromFormat('Y-m-d H:i:s', $CheckWeek->start)->format('m/d/Y');
        $LiveDate = Carbon::now()->format('m/d/Y');
        $Week =  $this->week_between_two_dates($StartDate, $LiveDate);


        $ProtocolCheckSelected = DB::table('protocol_another')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->whereNull('selected')->get();

        $CheckCountSelected = count($ProtocolCheckSelected);



        $GetProtocol   = DB::table('protocol_heading')
            ->select('service_id','user_id')
            ->where('practitioner_id',$practitionerID)
            ->where('meeting_id',$meetingID)
            ->groupBy('service_id','user_id')
            ->get();

        $Practitioner = DB::table('practitioner')->where('id',$practitionerID)->first();

       $StartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $CheckWeek->start)->format('Y-m-d H:i:s');
        $LiveDateTime = Carbon::now()->format('Y-m-d H:i:s');

        if($StartDateTime > $LiveDateTime)
        {
            return Redirect::to('en/my-appointments-customer/2');
        }

        if(count($ProtocolAnother) === 0 )
        {
            return back()->with('status','The doctor has not added a protocol yet.');
        }


        return view('protocol-view-customer',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','GetProtocol','ProtocolAnother','Services','Week','CheckCountSelected','Practitioner','meetingID'));
    }

    public function addSelectProtocol(request $request, $lang,$practitionerID,$serviceID)
    {

        foreach ($request->another_id as $key => $value) {

            if (isset($request->another[$key])) {
                $Edit = DB::table('protocol_another')->where('service_id', $serviceID)->where('user_id', Auth::id())->where('practitioner_id', $practitionerID)->where('id', $value)->update(['selected' => $request->another[$key]]);
            } else {
                return back();
            }
        }

        return back()->with('status','Your request has been completed.');


    }


    public function addReview(Request $request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'add_rate' => 'required',
            'add_review' => 'required',
            'practitioner_id' => 'required',
            'meeting_id' => 'required',
        ]);


        $Add = new ReviewModel;
        $Add->rate = $request->add_rate;
        $Add->description = $request->add_review;
        $Add->practitoner_id = $request->practitioner_id;
        $Add->user_id = Auth::id();
        $Add->meeting_id  = $request->meeting_id;
        $Add->save();

        return back()->with('status','Review saved');

    }
}
