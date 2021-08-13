<?php

namespace App\Http\Controllers;

use App\Models\Admin\CategoryModel;
use App\Models\Card;
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

use Hash;
use File;

class PractitionersController extends Controller
{
    public function __construct()
    {
        return $this->middleware('CheckLoginPractitioner');
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

    public function profilePractitioner()
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

        $ThisWeekMeetingsList = ZoomModel::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();




        return view('profile-practitioner',compact('TagManagements','MyTagManagements','PractitionerInfo','ThisWeekMeetingsList','Service','ServiceSession','ServiceDescription'));
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

    public function myAppointmentsPractitioners()
    {
        return view('my-appointments-practitioners');
    }

    public function typeFormPractitioner(request $request)
    {
         $TypeForm = TypeFormModel::where('practitioner_id',$request->session()->get('UserID'))->get();

        return view('type-form',compact('TypeForm'));
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

    public function deleteService($lang,$ServeiceID)
    {
        $DeleteService = ServicesModel::where('id', $ServeiceID)->first();
        $DeleteService->delete();


        foreach ($DeleteServiceSession = ServiceSessionModel::where('services_id', $ServeiceID)->get() as $val)
        {
            $DeleteServiceSession = ServiceSessionModel::where('services_id', $ServeiceID)->first();
            $DeleteServiceSession->delete();
        }


        foreach ($DeleteServiceSession = ServiceDescriptionModel::where('services_id', $ServeiceID)->get() as $val)
        {
            $DeleteServiceDescription = ServiceDescriptionModel::where('services_id', $ServeiceID)->first();
            $DeleteServiceDescription->delete();
        }

        return redirect(app()->getLocale()."/edit-profile-practitioner")->with('status','Delete service');
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


}
