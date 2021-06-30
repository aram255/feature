<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DB,File;
use App\Models\AuthPractitionersModel;
//use App\Models\PractitionersModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\PracticeModel;
use App\Models\SpecialitiesModel;
use App\Models\TimeZoneModel;


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
        $city['data'] =  CityModel::orderby("title","asc")->where('country_id',$Country_id)->get();
          return response()->json($city);
    }

    public function timeZone()
    {
        return TimeZoneModel::orderby("timezones","asc")->get();
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
            'mode_of_delivery'         => 'required',
            'additional_document'      => 'required',
            'id_or_passport'           => 'required',
            'certifications_licensing' => 'required',
            'practice_id'              => 'required',
            'speciality_id'            => 'required',
            'email'                    => 'required|email|unique:users',
            'password'                 => 'required|min:6',
        ]);


        $data = $request->all();

        // $name = $data['additional_document']->getClientOriginalName();
        // $path = $data['additional_document']->store('public');

        $document_name     = rand() . '.' . $data['additional_document']->getClientOriginalExtension();
        $data['additional_document']->move(public_path('web_sayt/upload_document/'), $document_name);


        $certifications_licensing     = rand() . '.' . $data['certifications_licensing']->getClientOriginalExtension();
        $data['certifications_licensing']->move(public_path('web_sayt/upload_document/'), $certifications_licensing);

        $id_or_passport     = rand() . '.' . $data['id_or_passport']->getClientOriginalExtension();
        $data['id_or_passport']->move(public_path('web_sayt/upload_document/'), $id_or_passport);

        $check = $this->create($data,$document_name,$certifications_licensing,$id_or_passport);

        return redirect(app()->getLocale()."/profile-practitioner")->withSuccess('You have signed-in');
    }

    public function create(array $data,$document_name,$certifications_licensing,$id_or_passport)
    {

        return AuthPractitionersModel::create([
            'first_name'               => $data['first_name'],
            'last_name'                => $data['last_name'],
            'phone_number'             => $data['phone_number'],
            'country_id'               => $data['country_id'],
            'time_zone'                => $data['time_zone'],
            'city_id'                  => $data['city_id'],
            'address'                  => $data['address'],
            'mode_of_delivery'         => $data['mode_of_delivery'],
            'practice_id'              => $data['practice_id'],
            'speciality_id'            => $data['speciality_id'],
            'additional_document'      => $document_name,
            'certifications_licensing' => $certifications_licensing,
            'id_or_passport'           => $id_or_passport,
            'email'                    => $data['email'],
            'password'                 => Hash::make($data['password'])
        ]);
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $userInfo = AuthPractitionersModel::where('email','=', $request->email)->first();

        if($userInfo and $userInfo->status == 'accept')
        {
            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('UserID', $userInfo->id);
                $request->session()->put('UserEmail', $userInfo->email);
                $request->session()->put('UserName', $userInfo->first_name);
                $request->session()->put('UserLastName', $userInfo->last_name);
                $request->session()->put('UserImg', $userInfo->img);
                return redirect(app()->getLocale()."/profile-practitioner");

            }else{
                return redirect(app()->getLocale()."/login-practitioners")->with('fail','Incorrect password');
            }

        }
        elseif($userInfo->status == 'pending')
        {
            return redirect(app()->getLocale()."/login-practitioners")->with('status','Pending');
        }
        elseif($userInfo->status == 'reject')
        {
            return redirect(app()->getLocale()."/login-practitioners")->with('status','Reject');
        }
        elseif($userInfo->status == 'disable')
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
