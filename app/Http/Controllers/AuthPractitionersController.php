<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DB,File;
use App\Models\AuthPractitionersModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\PracticeModel;
use App\Models\SpecialitiesModel;
use App\Models\TimeZoneModel;
use App\Models\AdditionalModel;
use App\Models\CertificationsModel;
use App\Models\PractitionerPracticeModel;
use App\Models\PractitionerSpecialitiesModel;


class AuthPractitionersController extends Controller
{
    public function __construct()
    {
        return $this->middleware('AuthPractitioners');
    }

    public function login()
    {
        return view('login-practitioners');
    }

    public function country()
    {
        return CountryModel::orderby("title","asc")->get();
    }

    public  function city($lang,$Country_id=0)
    {
        $city['data'] =  CityModel::distinct()->where('country_id',$Country_id)->get(['title']);
          return response()->json($city);
    }

    public function timeZone()
    {
        return TimeZoneModel::orderby("value","asc")->get();
    }

    public function practice()
    {
        return PracticeModel::orderby("title","asc")->get();
    }

    public function specialities()
    {
        return SpecialitiesModel::orderby("title","asc")->get();
    }

    public function register()
    {
        //dd(Auth::id());
         $GetCountry      = $this->country();
         $GetPractice     = $this->practice();
         $GetSpecialities = $this->specialities();
         $GetTimeZone     = $this->timeZone();

          return view('sign-up-practitioners',compact("GetCountry","GetPractice","GetSpecialities","GetTimeZone"));
    }

    public function customRegistration(request $request)
    {

        $request->validate([
            'first_name'               => 'required',
            'last_name'                => 'required',
            'phone_number'             => 'required',
            'country_id'               => 'required',
            'city_id'                  => 'required',
            'address'                  => 'required',
            'time_zone'                => 'required',
            'virtual'                  => 'required_without:in_persion',
            'in_persion'                => 'required_without:virtual',
            'additional_document'      => 'required',
            'id_or_passport'           => 'required',
            'certifications_licensing' => 'required',
            'practice_id'              => 'required',
            'speciality_id'            => 'required',
            'email'                    => 'required|email|unique:users',
            'password'                 => 'required|min:6',
        ]);




        $data = $request->all();

        $id_or_passport     = rand() . '.' . $data['id_or_passport']->getClientOriginalExtension();
        $data['id_or_passport']->move(public_path('web_sayt/upload_document/'), $id_or_passport);

        if($files=$request->hasfile('additional_document'))
        {
            foreach($request->file('additional_document') as $file){
                $name=rand() . '.' .$file->getClientOriginalExtension();
                $file->move(public_path().'/web_sayt/upload_document/', $name);
                $images[]=$name;
                $form_data = array(
                    'img' => $images
                );
         }
        }

        if($files=$request->hasfile('certifications_licensing'))
        {
            foreach($request->file('certifications_licensing') as $file){
                $namee=rand() . '.' .$file->getClientOriginalExtension();
                $file->move(public_path().'/web_sayt/upload_document/', $namee);
                $imagess[]=$namee;
                $Certifications = array(
                    'certifications' => $imagess
                );
            }
        }

        $check = $this->create($form_data,$Certifications,$data,$id_or_passport,$request->practice_id,$request->speciality_id);

     return redirect(app()->getLocale()."/profile-practitioner")->withSuccess('You have signed-in');
    }


    public function create(array $form_data,$Certifications,$data,$id_or_passport,$practiceID,$specialitiesID)
    {

        $practitioner = new AuthPractitionersModel;

        $practitioner->first_name      = $data['first_name'];
        $practitioner->last_name       = $data['last_name'];
        $practitioner->phone_number    = $data['phone_number'];
        $practitioner->country_id      = $data['country_id'];
        $practitioner->time_zone       = $data['time_zone'];
        $practitioner->city_id         = $data['city_id'];
        $practitioner->address         = $data['address'];
        if(!empty($data['virtual']))
        {
        $practitioner->virtuall         = $data['virtual'];
        }
        if(!empty($data['in_persion']))
        {
        $practitioner->in_persion       = $data['in_persion'];
        }

        $practitioner->id_or_passport  = $id_or_passport;
        $practitioner->email           = $data['email'];
        $practitioner->password        = Hash::make($data['password']);
        $practitioner->save();


        foreach ($form_data['img'] as $data)
        {
            $Ad = new AdditionalModel;
            $Ad->additional_document = $data;
            $Ad->practitioner_id = $practitioner->id;
            $Ad->save();
        }

        foreach ($Certifications['certifications'] as $data)
        {
            $Add = new CertificationsModel;
            $Add->certifications_licensing = $data;
            $Add->practitioner_id = $practitioner->id;
            $Add->save();
        }

        foreach ($practiceID as $value)
        {
            $AddPractice                  = new PractitionerPracticeModel;
            $AddPractice->practice_id     = $value;
            $AddPractice->practitioner_id = $practitioner->id;
            $AddPractice->save();
        }

        foreach ($specialitiesID as $value)
        {
            $AddSpecialities                  = new PractitionerSpecialitiesModel;
            $AddSpecialities->specialities_id = $value;
            $AddSpecialities->practitioner_id = $practitioner->id;
            $AddSpecialities->save();
        }

    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $userInfo = AuthPractitionersModel::where('email','=', $request->email)->first();
//        dd($userInfo->status);
        if($userInfo and $userInfo->status == 'accept')
        {

            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('UserID', $userInfo->id);
                $request->session()->put('UserEmail', $userInfo->email);
                $request->session()->put('UserName', $userInfo->first_name);
                $request->session()->put('UserLastName', $userInfo->last_name);
                $request->session()->put('UserImg', $userInfo->img);

              // Auth::login($userInfo);
                return redirect(app()->getLocale()."/profile-practitioner");

            }else{
                return redirect(app()->getLocale()."/login-practitioners")->with('fail','Incorrect password');
            }

        }
        elseif(!empty($userInfo->status) and $userInfo->status == 'pending')
        {
            return redirect(app()->getLocale()."/login-practitioners")->with('status','Pending');
        }
        elseif(!empty($userInfo->status) and $userInfo->status == 'reject')
        {
            return redirect(app()->getLocale()."/login-practitioners")->with('status','Reject');
        }
        elseif(!empty($userInfo->status) and $userInfo->status == 'disable')
        {
            return redirect(app()->getLocale()."/login-practitioners")->with('status','Disable');
        }
        else{
            return redirect(app()->getLocale()."/login-practitioners")->with('status','We do not recognize your email address');
        }

    }

    public function LogOut(Request $request)
    {
        $RemoveAll =  Session::flush();
//        if($RemoveAll)
//        {
            return redirect(app()->getLocale().'/login-practitioners');
        //}

    }



}
