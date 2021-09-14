<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use DB;
use Session;
use App\Models\AuthPractitionersModel;

use Exception;

class LoginGoogleCustommerController extends Controller
{
    public function redirect($en,$id, request $request)
    {
        $request->session()->put('user_type', $id);

        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        if(session()->get('user_type') == 1)
        {
            try {
                $user_info_google = Socialite::driver('google')->user();
                $user = User::where('google_id', $user_info_google->id)->first();

                if($user){
                    Auth::login($user);
                  //  dd('sdsd');
                    return redirect('/');
                }else{

                    $newUser = User::create([
                        'first_name' => $user_info_google->name,
                        'email' => $user_info_google->email,
                        'google_id'=> $user_info_google->id,
                        'password' => encrypt('123456dummy')
                    ]);
                    Auth::login($newUser);

                    return redirect('/');
                }
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }elseif(session()->get('user_type') == 2)
        {
            try {
                $user_info_google = Socialite::driver('google')->user();
                $user = AuthPractitionersModel::where('google_id', $user_info_google->id)->first();

                if($user){
                    AuthPractitionersModel::login($user);
                    //  dd('sdsd');
                    return redirect('/');
                }else{

                    $newUser = AuthPractitionersModel::create([
                        'first_name' => $user_info_google->name,
                        'email' => $user_info_google->email,
                        'google_id'=> $user_info_google->id,
                        'password' => encrypt('123456dummy')
                    ]);
                    AuthPractitionersModel::login($newUser);

                    return redirect('/');
                }
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    }
}
