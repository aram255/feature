<?php

namespace App\Http\Controllers;

use App\Models\Admin\CategoryModel;
use App\Models\Card;
use App\Models\ReviewModel;
use Illuminate\Http\Request;
use App\Models\PractitionersModel;
use App\Models\TegManagements;
use App\Models\TegManagementsPractitionerModel;
use App\Models\TypeFormModel;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AuthPractitionersModel;
use App\Models\PractitionerLanguageModel;
use App\Models\ZoomModel;
use App\Models\ServiceDescriptionModel;
use App\Models\ServiceSessionModel;
use App\Models\ServicesModel;
use Illuminate\Support\Carbon;
//use Illuminate\Pagination\Paginator;
//use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ProtocolHeading;
use App\Models\ProtocolProduct;
use App\Models\ProtocolLink;
use App\Models\ProtocolAnotherModel;
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Hash;
use File;
use URL;
use DateTime;
use DateTimeZone;

class PractitionersController extends Controller
{
    public function __construct()
    {
        include  base_path("vendor/autoload.php");
        $this->middleware('CheckLoginPractitioner');

        /*
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET','https://api.typeform.com/forms/XUM3YVna/responses', [
            "headers" => [addEditProtocol
                "Authorization" => "Bearer FV9vg5moHUTBwAjPV987cErmTPv4AHtX7cqXf4rhcwjW"
            ]
        ]);


        $data = json_decode($response->getBody());
        $answers = array_column($data->items, 'answers');
        $mail=[];

        foreach ($answers as $val)
        {
            $email =  array_column($val, 'email');

            if (isset($email[0])) {
                $mail[] = $email[0];
            }
        }
*/
//        dd($mail);

    }

    public function getLanguage()
    {
        $PractitonerID = session()->get('UserID');
       return DB::select("select l.*, case when pl.lang_id is null then 0 else 1 end as selected
                                       from languages as l left join practitioner_lang_rel as pl on l.id=pl.lang_id and pl.practitioner_id=$PractitonerID
                                       ");

    }

    public function getPractitioners()
    {
        return PractitionersModel::where('id',session()->get('UserID'))->first();
    }

    public function profilePractitioner(Request $request,$lang, $practitioner_id = null, $service_id = null)
    {

        $Service  =  ServicesModel::where('practitioner_id',session()->get('UserID'))->get();

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


        $TagManagements = TegManagements::orderBy('published', 'DESC')->orderBy('id', 'DESC')->get();

        $MyTagManagements = DB::table('teg_managements')
                            ->join('practitioner_teg_managements', 'practitioner_teg_managements.teg_managements_id', 'teg_managements.id')
                            ->where('practitioner_teg_managements.practitioner_id',session()->get('UserID'))
                            ->where('published',1)
                            ->get();




        $PractitionerInfo= AuthPractitionersModel::where('id',session()->get('UserID'))->first();

        $ThisWeekMeetingsList = ZoomModel::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('practitioner_id',session()->get('UserID'))->where('user_id','!=',null)->get();

        $GetServiceID = ZoomModel::where('practitioner_id',session()->get('UserID'))->where('join_url','!=',null)->get();


        $Review = DB::table('reviews')
            ->select('reviews.rate','reviews.description','users.last_name','users.first_name','users.img','reviews.created_at')
            ->join('users', 'users.id', 'reviews.user_id')
            ->where('reviews.practitoner_id',session()->get('UserID'))
            ->where('reviews.description','!=',null)
            ->get();

        // Calendar
        if($request->ajax())
        {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');


            $data = ZoomModel::whereDate('start', '>=', $start)
                //->select('practitioner_id','start','end','duration','join_url','user_id')
                ->whereDate('end',   '<=', $end)
                ->where('practitioner_id',session()->get('UserID'))
                //->groupBy('practitioner_id','start','end','duration','join_url','user_id')
                ->get();

            return response()->json($data);

        }

        $Complete  = DB::table('users')
            ->select('users.id as user_id','zoom_meetings_list.practitioner_id as practitioner_idd','users.img as user_img','services.id as service_id','users.first_name','users.last_name','services.title','zoom_meetings_list.title','zoom_meetings_list.id as meeting_id')
            ->join('zoom_meetings_list', 'users.id', 'zoom_meetings_list.user_id')
            ->where('zoom_meetings_list.practitioner_id',$request->session()->get('UserID'))
            ->join('services','services.id','zoom_meetings_list.service_id')
            ->join('protocol_heading','protocol_heading.meeting_id','zoom_meetings_list.id')
            ->whereDate("zoom_meetings_list.start", "<=",date('Y-m-d'))
           ->GroupBy('user_id','practitioner_idd','user_img','service_id','users.first_name','users.last_name','services.title','zoom_meetings_list.title','zoom_meetings_list.meeting_id')
            //->orderBy('zoom_meetings_list.id','DESC')
           ->get();

        $ReviewRate = DB::table('reviews')
            ->where('reviews.practitoner_id',$request->session()->get('UserID'))
            ->avg('rate');

        $Rate = floor($ReviewRate);




        return view('profile-practitioner',compact('Complete','GetServiceID','Review','TagManagements','MyTagManagements','PractitionerInfo','ThisWeekMeetingsList','Service','ServiceSession','ServiceDescription','Rate'));
    }

    public function calendarAddFreeDate(request $request)
    {

        $CheckSelectMeeting = ZoomModel::where('practitioner_id',session()->get('UserID'))
            ->where('start',$request->start)
            ->where('end',$request->end)
            ->first();

        if(empty($CheckSelectMeeting))
        {
            $Add = new ZoomModel;
           // $Add->title            = $request->title;
            $Add->start            = $request->start;
            $Add->end              = $request->end;
            $Add->create           = $request->LiveDateTime;
            $Add->practitioner_id  = session()->get('UserID');
            $Add->save();

            return response()->json(['success'=> 'Hours that are not convenient for you have been added to the calendar.']);
        }
        else{
            return response()->json(['error' => 'Hours that are not convenient for you have not been added to the calendar.']);
        }
    }

    public function calendarEditFreeDate(request $request)
    {

        $Edit = ZoomModel::where('id',$request->event_id)->where('user_id','=',null)->first();
        $Edit->start = $request->start;
        $Edit->end   = $request->end;
        $Edit->save();

        return response()->json(['success'=>'The list of your busy hours has been removed.','error'=>'The list of your busy hours has not been removed.']);
    }

    public function calendarDeleteFreeDate(request $request)
    {

//        $GetList = ZoomModel::where('practitioner_id',$request->practitioner_id)->where('join_url','=',null)->get();
//        foreach ($GetList as $GetFreeId)
//        {

        $CheckSelectMeeting = ZoomModel::where('practitioner_id',session()->get('UserID'))
            ->where('start',$request->start)
            ->where('end',$request->end)
            ->where('user_id','!=',null)
            ->first();

        if(!isset($CheckSelectMeeting->user_id))
        {
            $Delete = ZoomModel::where('id',$request->event_id)->where('join_url','=',null)->first();
            $Delete->delete();

                return response()->json(['success'=> 'The list of your busy hours has been removed.']);
        }
        else{
                return response()->json(['error' => 'No puedes eliminarlo porque ya está arreglado.']);
        }

//        if(empty($CheckSelectMeeting))
//        {
//            $Delete = ZoomModel::where('id',$request->event_id)->where('join_url','=',null)->first();
//            $Delete->delete();
//        }

       // return response()->json(['success'=>'The list of your busy hours has been removed.','error'=>'The list of your busy hours has not been removed.']);
    }

    public  function addTagMyListManagements(request $request)
    {


        $AddProtocol = new TegManagementsPractitionerModel;
        $AddProtocol->practitioner_id = session()->get('UserID');
        $AddProtocol->teg_managements_id    = $request->teg_managements_id;
        $AddProtocol->save();

           return response()->json($AddProtocol);
    }


    public function deleteTeg(request $request)
    {

        $Delete = TegManagementsPractitionerModel::where('practitioner_id',session()->get('UserID'))
                                        ->where('teg_managements_id',$request->teg_managements_id)
                                        ->delete();

          return response()->json($Delete);
    }



    public function addTagManagements(request $request)
    {
        $request->validate([
            'add_teg' => 'required',
        ]);

        $Add = new TegManagements;
        $Add->published  = 0;
        $Add->name       = $request->add_teg;
        $Add->save();

       // return back()->withInput();
        return response()->json($Add);
    }

    public  function EditProfilePractitioner()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();

        $Service  =  ServicesModel::where('practitioner_id',session()->get('UserID'))->get();

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

        $PractitonerID = session()->get('UserID');

        $MyTagManagements =  DB::select("select t.*, case when pt.teg_managements_id is null then 0 else 1 end as selected
                                       from teg_managements as t left join practitioner_teg_managements as pt on t.id=pt.teg_managements_id and pt.practitioner_id=$PractitonerID
                                       where published=1");

        $Lang          = $this->getLanguage();
        $Practitioners = $this->getPractitioners();


        return view('edit-profile-practitioner', compact('Practitioners','cards','Service','ServiceSession','ServiceDescription','MyTagManagements','Lang'));
    }

    public function removeCardPractitioner()
    {
        $DeleteCard = PractitionersModel::where('id',session()->get('UserID'))->first();

        $DeleteCard->card_number = '';
        $DeleteCard->save();
             if(!empty($DeleteCard))
             {
                 return back()->with('status','Your card information has been deleted.');
             }

    }

    public function myAppointmentsPractitioners(request $request,$lang,$id)
    {

     //  dd(date('Y-m-d H:i:s'));

        //$tz = 'Asia/Russian';
//        $timestamp = time();
//        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
//        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
//        echo $dt->format('Y-m-d H:i:s');


        $InProcess = DB::table('users')
                     ->join('zoom_meetings_list', 'users.id', 'zoom_meetings_list.user_id')
                     ->where('zoom_meetings_list.practitioner_id',$request->session()->get('UserID'))
                     //->whereDate("zoom_meetings_list.start", ">=",$dt->format('Y-m-d H:i:s'))
                     ->whereDate("zoom_meetings_list.start", ">=",date('Y-m-d H:i:s'))
                     ->orderBy('zoom_meetings_list.id','DESC')
                     ->paginate(5);



        $Complete  = DB::table('users')
                     ->join('zoom_meetings_list', 'users.id', 'zoom_meetings_list.user_id')
                     ->where('zoom_meetings_list.practitioner_id',$request->session()->get('UserID'))
          //  ->join('protocol_heading','protocol_heading.meeting_id','zoom_meetings_list.id')
                    // ->whereDate("zoom_meetings_list.start", "<=",$dt->format('Y-m-d H:i:s'))
                     ->whereDate("zoom_meetings_list.start", "<=",date('Y-m-d H:i:s'))
            //->GroupBy('user_id','practitioner_idd','user_img','service_id','users.first_name','users.last_name','services.title','zoom_meetings_list.title','zoom_meetings_list.meeting_id')
                     ->orderBy('zoom_meetings_list.id','DESC')
                     ->paginate(5);


            $StatusProtocol = DB::table('protocol_heading')->where('practitioner_id',$request->session()->get('UserID'))->get();


        return view('my-appointments-practitioners',compact('InProcess','Complete','id','StatusProtocol'));
    }

    public function typeFormPractitioner(request $request)
    {
         $TypeForm = TypeFormModel::where('practitioner_id',$request->session()->get('UserID'))->get();

        return view('type-form',compact('TypeForm'));
    }

    public function DefaultTypeFormPractitioner(request $request,$lang,$id)
    {

        $TypeForm = TypeFormModel::where('practitioner_id',$request->session()->get('UserID'))->get();

        foreach ($TypeForm as $value)
        {
            $NullDefaultTypeForm = TypeFormModel::where('practitioner_id',$request->session()->get('UserID'))
                ->where('id', $value->id)->first();

                $NullDefaultTypeForm->defaultt = null;
                $NullDefaultTypeForm->save();
        }

        $DefaultTypeForm = TypeFormModel::where('practitioner_id',$request->session()->get('UserID'))
            ->where('id',$id)
            ->first();

        $DefaultTypeForm->defaultt = 1;
        $DefaultTypeForm->save();


        return  back()->with('status','Was selected by default');
    }

    public function typeFormPractitionerView($lang,$id)
    {
        $TypeFormView = TypeFormModel::find($id);

        return view('type-form-view',compact('TypeFormView'));
    }

    public function addTypeFormPractitioner(request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        $Add = new TypeFormModel;

        $Add->title           = $request->title;
        $Add->url             = $request->url;
        $Add->practitioner_id = $request->session()->get('UserID');
        $Add->save();

            return  back()->with('status','Add Intake Forms');

    }

    public function editTypeFormPractitioner(request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);


        $Edit = TypeFormModel::find($request->id);

        $Edit->title           = $request->title;
        $Edit->url             = $request->url;
        $Edit->save();

        return  back()->with('status','Edit Intake Forms');

    }

    public function deleteTypeFormPractitioner(request $request)
    {
        foreach ($request->form_id as $ID) {
            $DeleteCategory = TypeFormModel::where('id', $ID)->first();
            $DeleteCategory->delete();
        }

        return  back()->with('status','Delete Intake Forms');
    }

    public function addService(request $request)
    {
        $request->validate([
            'title'               => 'required',
            'price'               => 'required',
            'sessiont_title'      => 'required',
            'description'         => 'required',
        ]);

       $AddService                  =  new ServicesModel;
       $AddService->title           = $request->title;
       $AddService->price           = $request->price;
       $AddService->practitioner_id = session()->get('UserID');
       $AddService->save();

       if(!empty($AddService->id))
       {
           foreach ($request->sessiont_title as $val)
           {
               $AddServiceSession        =  new ServiceSessionModel;
               $AddServiceSession->sessions     =  $val;
               $AddServiceSession->services_id  =  $AddService->id;
               $AddServiceSession->save();
           }

           foreach ($request->description as $value)
           {
               $AddServiceDescription               =  new ServiceDescriptionModel;
               $AddServiceDescription->description  =  $value;
               $AddServiceDescription->services_id  =  $AddService->id;
               $AddServiceDescription->save();
           }

           return redirect(app()->getLocale()."/edit-profile-practitioner")->with('status','Add services');

       }

    }

    public function editService(request $request)
    {
        $EditService  =  ServicesModel::where('practitioner_id',session()->get('UserID'))->where('id',$request->serveice_id)->first();

        $EditService->title = $request->title;
        $EditService->price = $request->price;
        $EditService->save();


        foreach ($request->sessions_id as $key => $val)
        {
            $EditServiceSession = ServiceSessionModel::where('id', $val)->first();
            $EditServiceSession->sessions = $request->session[$key];
            $EditServiceSession->save();
        }

        foreach ($request->description_id as $key => $value)
        {
            $EditServiceDescription = ServiceDescriptionModel::where('id', $value)->first();
            $EditServiceDescription->description = $request->description[$key];
            $EditServiceDescription->save();
        }

        return redirect(app()->getLocale()."/edit-profile-practitioner")->with('status','Edit services');
    }

    public function deleteService(request $request)
    {
        $DeleteService = ServicesModel::where('id', $request->DeleteIDS)->first();
        $DeleteService->delete();


        foreach ($DeleteServiceSession = ServiceSessionModel::where('services_id', $request->DeleteIDS)->get() as $val)
        {
            $DeleteServiceSession = ServiceSessionModel::where('services_id', $request->DeleteIDS)->first();
            $DeleteServiceSession->delete();
        }


        foreach ($DeleteServiceSession = ServiceDescriptionModel::where('services_id', $request->DeleteIDS)->get() as $val)
        {
            $DeleteServiceDescription = ServiceDescriptionModel::where('services_id', $request->DeleteIDS)->first();
            $DeleteServiceDescription->delete();
        }

        //return redirect(app()->getLocale()."/edit-profile-practitioner")->with('status','Delete service');
        return response()->json(['deleteservice' => 'Delete Service']);
    }

    public function EditProfilePractitionerPost(request $request)
    {

//        dd($request->file('img'));
        $EditPractitioner = PractitionersModel::where('id', session()->get('UserID'))->first();
        if(empty($request->file('img')) and empty($request->file('video')))
        {

            $EditPractitioner->first_name   = $request->first_name;
            $EditPractitioner->last_name    = $request->last_name;
            $EditPractitioner->phone_number = $request->phone_number;
            $EditPractitioner->email        = $request->email;
            $EditPractitioner->insurance    = $request->insurance;
            $EditPractitioner->description  = $request->description;
            if ($EditPractitioner && in_array($request->gender, array('Male', 'Famale', 'Other'))) {
                $EditPractitioner->gender = $request->gender;
            }

        }
        elseif($request->file('video')==null)
        {

            $ImgName = rand() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('web_sayt/img_practitioners/'), $ImgName);

//            if (File::exists(public_path('web_sayt/img_practitioners/' . $EditPractitioner->img))) {
//                File::delete(public_path('web_sayt/img_practitioners/' . $EditPractitioner->img));
//            }

            $EditPractitioner->img = $ImgName;
            $EditPractitioner->first_name   = $request->first_name;
            $EditPractitioner->last_name    = $request->last_name;
            $EditPractitioner->phone_number = $request->phone_number;
            $EditPractitioner->email        = $request->email;
            $EditPractitioner->insurance    = $request->insurance;
            $EditPractitioner->description  = $request->description;
            if ($EditPractitioner && in_array($request->gender, array('Male', 'Famale', 'Other'))) {
                $EditPractitioner->gender = $request->gender;
            }
        }
        elseif($request->file('img')==null )
        {
            $VideoName = rand() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('web_sayt/video_practitioners/'), $VideoName);

//            if (File::exists(public_path('web_sayt/video_practitioners/' . $EditPractitioner->video))) {
//                File::delete(public_path('web_sayt/video_practitioners/' . $EditPractitioner->video));
//            }

            $EditPractitioner->video = $VideoName;
            $EditPractitioner->first_name   = $request->first_name;
            $EditPractitioner->last_name    = $request->last_name;
            $EditPractitioner->phone_number = $request->phone_number;
            $EditPractitioner->email        = $request->email;
            $EditPractitioner->insurance    = $request->insurance;
            $EditPractitioner->description  = $request->description;
            if ($EditPractitioner && in_array($request->gender, array('Male', 'Famale', 'Other'))) {
                $EditPractitioner->gender = $request->gender;
            }
        }
        else{

            $ImgName = rand() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('web_sayt/img_practitioners/'), $ImgName);

//            if (File::exists(public_path('web_sayt/img_practitioners/' . $EditPractitioner->img))) {
//                File::delete(public_path('web_sayt/img_practitioners/' . $EditPractitioner->img));
//            }

            $VideoName = rand() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('web_sayt/video_practitioners/'), $VideoName);
//
//            if (File::exists(public_path('web_sayt/video_practitioners/' . $EditPractitioner->video))) {
//                File::delete(public_path('web_sayt/video_practitioners/' . $EditPractitioner->video));
//            }

            $EditPractitioner->video = $VideoName;
            $EditPractitioner->img = $ImgName;
            $EditPractitioner->first_name = $request->first_name;
            $EditPractitioner->last_name = $request->last_name;
            $EditPractitioner->phone_number = $request->phone_number;
            $EditPractitioner->email = $request->email;
            $EditPractitioner->insurance = $request->insurance;
            $EditPractitioner->description = $request->description;
            if ($EditPractitioner && in_array($request->gender, array('Male', 'Famale', 'Other'))) {
                $EditPractitioner->gender = $request->gender;
            }
        }
        $EditPractitioner->save();

        if($request->password != null)
        {
            //check password
            $EditPractitionerpassword = PractitionersModel::where('id', session()->get('UserID'))->first();

            if (Hash::check($request->password, $EditPractitionerpassword->password))
            {

                if (Hash::check($request->new_password, Hash::make($request->conf_password)))
                {
                    $request->validate([
                        "new_password" => 'required|'
                    ]);
                    $EditPractitionerpassword->password = Hash::make($request->new_password);
                    $EditPractitionerpassword->save();
                    if(!empty($EditPractitionerpassword))
                    {
                        return back()->with('status','Your request has been completed.');
                    }


                }else{
                    return back()->with('status','Please fill in both fields correctly.');
                }

            }else{
                return back()->with('status','The password you entered is incorrect');
            }
        }


        if($request->password == null || $request->new_password == null || $request->conf_password || ($request->new_password != $request->conf_password))
        {
                return back()->with('status','Your request has been completed.');
        }

    }



    public function addLang(request $request)
    {
        $AddLang                  = new PractitionerLanguageModel;
        $AddLang->practitioner_id = session()->get('UserID');
        $AddLang->lang_id = $request->lang_id;
        $AddLang->save();

             return response()->json($AddLang);
    }

    public function deleteLang(request $request)
    {
        $DeleteLang = PractitionerLanguageModel::where('practitioner_id',session()->get('UserID'))->where('lang_id',$request->lang_id)->first();
        $DeleteLang->delete();

          return response()->json($DeleteLang);
    }

    public function deletePhotoVideo($lang,$id)
    {

        $EditVideoPhoto = PractitionersModel::where('id', session()->get('UserID'))->first();

        if($id == 1)
        {
            $EditVideoPhoto->img = '';
        }

        if($id == 2)
        {
            $EditVideoPhoto->video = '';
        }

        $EditVideoPhoto->save();

        return back()->with('status','Your request has been completed.');
    }

    public function protocol($Lang,$UserID,$ServiceID)
    {

//        $ProtocolHeading =   ProtocolHeading::where('service_id',$ServiceID)
//                             ->where('user_id',$UserID)
//                             ->where('practitioner_id',session()->get('UserID'))
//                             ->first();

        return view('protocol');
    }

    public function AddProtocol(request $request)
    {



        foreach ($request->another as $ValAnother)
        {
            if(!empty($ValAnother))
            {
                $Add = new ProtocolAnotherModel;
                $Add->name = $ValAnother;
                $Add->user_id = $request->user_id;
                $Add->service_id = $request->service_id;
                $Add->practitioner_id = session()->get('UserID');
                $Add->meeting_id = $request->meeting_id;
                $Add->save();
            }
        }

        foreach ($request->text_heading as $ValHeading)
        {
            if(!empty($ValHeading))
            {
                $Add = new ProtocolHeading;
                $Add->text_heading = $ValHeading;
                $Add->user_id = $request->user_id;
                $Add->service_id = $request->service_id;
                $Add->practitioner_id = session()->get('UserID');
                $Add->meeting_id = $request->meeting_id;
                $Add->save();
            }
        }

        foreach ($request->title_product as $keyProduct => $valProduct) {

            if (!empty($valProduct)) {

                if (empty($request->file('img')[$keyProduct])) {
                    $input['title_product'] = $valProduct;
                    // $input['brand']  = $request->brand[$keyProduct];
                    // $input['dosage'] = $request->dosage[$keyProduct];
                    // $input['instructions'] = $request->instructions[$keyProduct];
                    $input['product_link'] = $request->product_link[$keyProduct];

                    $input['user_id'] = $request->user_id;
                    $input['service_id'] = $request->service_id;
                    $input['practitioner_id'] = session()->get('UserID');
                    $input['meeting_id'] = $request->meeting_id;
                    ProtocolProduct::create($input);

                } else {
//            $request->validate([
//                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            ]);

                    $ImgName[$keyProduct] = rand() . '.' . $request->file('img')[$keyProduct]->getClientOriginalExtension();
                    $request->file('img')[$keyProduct]->move(public_path('web_sayt/img_protocol/'), $ImgName[$keyProduct]);

                    $input['title_product'] = $valProduct;
                    // $input['brand']  = $request->brand[$keyProduct];
                    // $input['dosage'] = $request->dosage[$keyProduct];
                    //  $input['instructions'] = $request->instructions[$keyProduct];
                    $input['product_link'] = $request->product_link[$keyProduct];
                    $input['user_id'] = $request->user_id;
                    $input['service_id'] = $request->service_id;
                    $input['practitioner_id'] = session()->get('UserID');
                    $input['meeting_id'] = $request->meeting_id;
                    $input['img'] = $ImgName[$keyProduct];

                    ProtocolProduct::create($input);
                }

               }
            }

            foreach ($request->link_title as $keyVal => $valLink) {
                if (!empty($valLink)) {
                    $inp['link_title'] = $valLink;
                    $inp['link_link'] = $request->link_link[$keyVal];
                    // $inp['iframe']    = $request->iframe[$keyVal];
                    $inp['user_id'] = $request->user_id;
                    $inp['service_id'] = $request->service_id;
                    $inp['practitioner_id'] = session()->get('UserID');
                    $inp['meeting_id'] = $request->meeting_id;

                    ProtocolLink::create($inp);
                }

            }


        return redirect(app()->getLocale().'/my-appointments-practitioners/2')->with('status','Add');
    }


    public function deleteProtocol(request $request)
    {

        $ProtocolAnother = DB::table('protocol_another')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',$request->practitioner_id)->where('meeting_id',$request->meeting_id)->delete();

        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',$request->practitioner_id)->where('meeting_id',$request->meeting_id)->delete();

        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',$request->practitioner_id)->where('meeting_id',$request->meeting_id)->delete();


        $ProtocolLink = DB::table('protocol_link')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',$request->practitioner_id)->where('meeting_id',$request->meeting_id)->delete();

        return response()->json($ProtocolHeading);
    }

    public function ViewProtocol($lang,$serviceID,$userID,$practitionerID,$meetingID)
    {
        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolLink    = DB::table('protocol_link')->where('service_id',$serviceID)->where('user_id',$userID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();


        $GetProtocol   = DB::table('protocol_heading')
                         ->select('service_id','user_id')
                         ->where('practitioner_id',$practitionerID)
                         ->groupBy('service_id','user_id')
                         ->get();


           return view('protocol-view-practitioner',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','GetProtocol'));
    }

    public function addEditProtocol($lang,$serviceID,$userID,$practitionerID,$meetingID)
    {


        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolLink    = DB::table('protocol_link')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();


        $GetProtocol   = DB::table('protocol_heading')
            ->select('service_id','user_id','meeting_id')
            ->where('practitioner_id',$practitionerID)
            ->where('meeting_id',$meetingID)
            ->groupBy('service_id','user_id')
            ->get();

        $ShowProtocol= DB::table('protocol_heading')
                                   ->select('service_id','user_id','meeting_id')
                                   ->groupBy('service_id','user_id')
                                   ->get();


        return view('protocol-view-practitioner-select-ajax',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','GetProtocol','ShowProtocol'));
    }

    public function EditProtocolView($lang,$serviceID,$userID,$practitionerID,$meetingID)
    {

        $ProtocolHeading  = DB::table('protocol_heading')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolProduct  = DB::table('protocol_product')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolLink     = DB::table('protocol_link')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolAnother  = DB::table('protocol_another')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $Service  = DB::table('services')->where('id',$serviceID)->where('practitioner_id',$practitionerID)->first();



        return view('edit-protocol',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','ProtocolAnother','Service'));
    }

    //
    public function EditViewProtocol($lang,$serviceID,$userID,$practitionerID,$meetingID)
    {

        $ProtocolHeading  = DB::table('protocol_heading')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolProduct  = DB::table('protocol_product')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolLink     = DB::table('protocol_link')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $ProtocolAnother  = DB::table('protocol_another')->where('service_id',$serviceID)->where('practitioner_id',$practitionerID)->where('meeting_id',$meetingID)->get();
        $Service  = DB::table('services')->where('id',$serviceID)->where('practitioner_id',$practitionerID)->first();

        return view('protocol-view-practitioner-edit',compact('ProtocolHeading','ProtocolProduct','ProtocolLink','ProtocolAnother','Service'));
    }

    public function EditProtocol(request $request)
    {

        foreach($request->another  as $KeyAnother => $ValAnother)
        {
            if(isset($request->id_another[$KeyAnother]))
            {
                $EditProtocolAnother = DB::table('protocol_another')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',session()->get('UserID'))->where('id',$request->id_another[$KeyAnother])->update(['name' => $ValAnother]);
            }
        }

        foreach($request->text_heading  as $KeyHeading => $ValHeading)
        {
//            if(isset($request->id_text_heading[$KeyHeading]))
//            {
               $EditProtocolHeading = DB::table('protocol_heading')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',session()->get('UserID'))->where('id',$request->id_text_heading[$KeyHeading])->update(['text_heading' => $ValHeading]);
//            }
        }

        foreach($request->id_Product  as $KeyProduct => $ValProduct)
        {
            if(empty($request->file('img')[$KeyProduct])) {

                $EditProtocolProduct = $ProtocolProduct = DB::table('protocol_product')->where('service_id', $request->service_id)->where('user_id', $request->user_id)->where('practitioner_id', session()->get('UserID'))->where('id', $ValProduct)
                    ->update([
                        'title_product' => $request->title_product[$KeyProduct],
                        //'brand' => $request->brand[$KeyProduct],
                        //'dosage' => $request->dosage[$KeyProduct],
                       // 'instructions' => $request->instructions[$KeyProduct],
                        'product_link' => $request->product_link[$KeyProduct]
                    ]);
            }else{
                $request->validate([
                    'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $ImgName[$KeyProduct] = rand() . '.' . $request->file('img')[$KeyProduct]->getClientOriginalExtension();
                $request->file('img')[$KeyProduct]->move(public_path('web_sayt/img_protocol/'), $ImgName[$KeyProduct]);

                $EditProtocolProduct = $ProtocolProduct = DB::table('protocol_product')->where('service_id', $request->service_id)->where('user_id', $request->user_id)->where('practitioner_id', session()->get('UserID'))->where('id', $ValProduct)
                    ->update([
                        'title_product' => $request->title_product[$KeyProduct],
                        //'brand' => $request->brand[$KeyProduct],
                        //'dosage' => $request->dosage[$KeyProduct],
                        //'instructions' => $request->instructions[$KeyProduct],
                        'product_link' => $request->product_link[$KeyProduct],
                        'img' => $ImgName[$KeyProduct]
                    ]);
            }
        }

        foreach($request->link_id  as $Keylink => $ValLink)
        {
            $EditProtocolLink = DB::table('protocol_link')->where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('practitioner_id',session()->get('UserID'))->where('id',$ValLink)
                ->update([
                    'link_title' => $request->link_title[$Keylink],
                    'link_link'  => $request->link_link[$Keylink]
                   // 'iframe'     => $request->iframe[$Keylink]
                ]);
        }

;

        // Insert
            foreach ($request->another as $keyA => $ValAnother) {
                if (empty($request->id_another[$keyA])) {
                    $Add = new ProtocolAnotherModel;
                    $Add->name = $ValAnother;
                    $Add->user_id = $request->user_id;
                    $Add->service_id = $request->service_id;
                    $Add->practitioner_id = session()->get('UserID');
                    $Add->meeting_id = $request->meeting_id;
                    $Add->save();
                }
            }


        foreach ($request->text_heading as $keyH => $ValHeading)
        {
            if(empty($request->id_text_heading[$keyH]))
            {
                $Add = new ProtocolHeading;
                $Add->text_heading = $ValHeading;
                $Add->user_id = $request->user_id;
                $Add->service_id = $request->service_id;
                $Add->practitioner_id = session()->get('UserID');
                $Add->meeting_id = $request->meeting_id;
                $Add->save();
            }
        }



//if(count($request->id_Product)>0) {


    $request->validate([

        'title_product.*' => 'required',
        'product_link.*' => 'required',
        'user_id.*' => 'required',
        'service_id.*' => 'required',
        'practitioner_id.*' => 'required',
        'img.*' => 'required',
    ]);

     if($request->file('img'))
     {
         foreach ($request->file('img') as $keyProduct => $valProductID) {


             if(!empty($valProductID))
             {
                 $input['title_product'] = $request->title_product[$keyProduct];

                 $input['product_link'] = $request->product_link[$keyProduct];
                 $input['user_id'] = $request->user_id;
                 $input['service_id'] = $request->service_id;
                 $input['practitioner_id'] = session()->get('UserID');
                 $input['meeting_id'] = $request->meeting_id;
                 $ImgNames[$keyProduct] = rand() . '.' . $request->file('img')[$keyProduct]->getClientOriginalExtension();
                 move_uploaded_file($_FILES["img"]["tmp_name"][$keyProduct], public_path('web_sayt/img_protocol/') . $ImgNames[$keyProduct]);
                 $input['img'] = $ImgNames[$keyProduct];

             }

             ProtocolProduct::create($input);
         }
     }



        foreach ($request->link_id as $keyVal => $valLink)
        {
            if(empty($valLink))
            {
                $inp['link_title'] = $request->link_title[$keyVal];;
                $inp['link_link'] = $request->link_link[$keyVal];
                //$inp['iframe'] = $request->iframe[$keyVal];
                $inp['user_id'] = $request->user_id;
                $inp['service_id'] = $request->service_id;
                $inp['practitioner_id'] = session()->get('UserID');
                $inp['meeting_id'] = $request->meeting_id;

                ProtocolLink::create($inp);
            }

        }

      return back()->with('status','Your data has changed.');


    }


    public function getDataProtocolAjax(request $request)
    {

        $ProtocolHeading = DB::table('protocol_heading')->where('service_id',$request->service_id)->where('practitioner_id',session()->get('UserID'))->where('meeting_id',$request->meeting_id)->get();
        $ProtocolProduct = DB::table('protocol_product')->where('service_id',$request->service_id)->where('practitioner_id',session()->get('UserID'))->where('meeting_id',$request->meeting_id)->get();
        $ProtocolLink    = DB::table('protocol_link')->where('service_id',$request->service_id)->where('practitioner_id',session()->get('UserID'))->where('meeting_id',$request->meeting_id)->get();
        $ProtocolAnother = DB::table('protocol_another')->where('service_id',$request->service_id)->where('practitioner_id',session()->get('UserID'))->where('meeting_id',$request->meeting_id)->get();

        return response()->json(['ProtocolHeading' => $ProtocolHeading, 'ProtocolProduct' => $ProtocolProduct, 'ProtocolLink' => $ProtocolLink, 'ProtocolAnother' => $ProtocolAnother]);
    }


//    public function getAutocomplete(Request $request)
//    {
//
//
//        if($request->get('query'))
//        {
//            $query = $request->get('query');
//            $data = DB::table('teg_managements')
//                ->where('name', 'LIKE', "%{$query}%")
//                ->get();
//            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
//            foreach($data as $row)
//            {
//                $output .= '
//       <li><a href="#">'.$row->name.'</a></li>
//       ';
//            }
//            $output .= '</ul>';
//            echo $output;
//        }
//    }

    public function confirmMeeting(request $request,$lang,$Code,$Status)
    {

        $ChangeStatus =  ZoomModel::where('check_code',$Code)->first();
        if($ChangeStatus != null)
        {
            $ChangeStatus->check_code = '?'.$Code;
            $ChangeStatus->status     = $Status;
            $ChangeStatus->save();

            if(isset($ChangeStatus->status) && $ChangeStatus->status == 'Accepted')
            {

                   $email = $request->segment(5);
                   $service_name = $request->segment(6);
                   $first_name = $request->segment(7);
                   $last_name = $request->segment(8);

                    $mail = Mail::send('email.confirm-meeting',
                        [
                            'service_name' => $service_name,
                            'email' => $email,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'status' => 'Accepted',

                        ], function ($message) use ($email) {
                            $message->from($email);
                            $message->to($email);
                            $message->subject('Status Zoom Meeting');
                        });
                    return redirect()->route('index',[app()->getLocale()])->with('status', 'Your meeting approved.');



            }elseif(isset($ChangeStatus->status) && $ChangeStatus->status == 'Rejected'){
                $email = $request->segment(5);
                $service_name = $request->segment(6);
                $first_name = $request->segment(7);
                $last_name = $request->segment(8);

                $mail = Mail::send('email.confirm-meeting',
                    [
                        'service_name' => $service_name,
                        'email' => $email,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'status' => 'Rejected',

                    ], function ($message) use ($email) {
                        $message->from($email);
                        $message->to($email);
                        $message->subject('Status Zoom Meeting');
                    });
                return redirect()->route('index',[app()->getLocale()])->with('status', 'Your meeting rejected.');
            }

        }else{
            return redirect()->route('index',[app()->getLocale()])->with('status', 'You can not change the status again.');
        }
    }
}
