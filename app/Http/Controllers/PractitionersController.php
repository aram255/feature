<?php

namespace App\Http\Controllers;

use App\Models\Admin\CategoryModel;
use App\Models\Card;
use Illuminate\Http\Request;
//use App\Models\PractitionersModel;
use App\Models\TegManagements;
use App\Models\TegManagementsPractitionerModel;
use App\Models\TypeFormModel;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AuthPractitionersModel;
use App\Models\ZoomModel;
use App\Models\ServiceDescriptionModel;
use App\Models\ServiceSessionModel;
use App\Models\ServicesModel;
use Illuminate\Support\Carbon;

class PractitionersController extends Controller
{
    public function __construct()
    {
        return $this->middleware('CheckLoginPractitioner');
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


        $TagManagements     = TegManagements::orderBy('published', 'DESC')->orderBy('id', 'DESC')->get();

        $MyTagManagements = DB::table('teg_managements')
                            ->join('practitioner_teg_managements', 'practitioner_teg_managements.teg_managements_id', 'teg_managements.id')
                            ->where('practitioner_teg_managements.practitioner_id',session()->get('UserID'))
                            ->where('published',1)
                            ->get();

        $PractitionerInfo= AuthPractitionersModel::where('id',session()->get('UserID'))->first();

        $ThisWeekMeetingsList = ZoomModel::whereBetween('start_date_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        return view('profile-practitioner',compact('TagManagements','MyTagManagements','PractitionerInfo','ThisWeekMeetingsList','Service','ServiceSession','ServiceDescription'));
    }

    public  function addTagMyListManagements(request $request)
    {

        foreach ($request->teg_management as  $AddTegManagementsID)
        {
            $CheckProtocol = TegManagementsPractitionerModel::where('practitioner_id',session()->get('UserID'))
                             ->where('teg_managements_id',$AddTegManagementsID)
                             ->first();

             if(!empty($CheckProtocol->teg_managements_id) && !empty($AddTegManagementsID) && $CheckProtocol->teg_managements_id == $AddTegManagementsID)
             {
                 echo 'Teg  Adding';
             }else{
                    // Add teg management
                $AddProtocol = new TegManagementsPractitionerModel;
                $AddProtocol->practitioner_id = session()->get('UserID');
                $AddProtocol->teg_managements_id    = $AddTegManagementsID;
                $AddProtocol->save();

             }

        }

        return back()->with('status','Adding tag My List');


    }

    public function deleteTeg(request $request)
    {

        foreach ($request->teg_management as  $DeleteTagId)
        {
                        TegManagementsPractitionerModel::where('practitioner_id',session()->get('UserID'))
                                                        ->where('teg_managements_id',$DeleteTagId)
                                                        ->delete();
        }

            return back()->with('status','Deleted tag');
    }



    public function addTagManagements(request $request)
    {
        $request->validate([
            'add_teg' => 'required',
        ]);

        $Add = new TegManagements;
        $Add->published = 0;
        $Add->name      = $request->add_teg;
        $Add->save();

        return back()->withInput();
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

        return view('edit-profile-practitioner', compact('cards','Service','ServiceSession','ServiceDescription'));
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


}
