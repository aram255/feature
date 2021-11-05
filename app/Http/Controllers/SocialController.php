<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use App\Models\User;
use DB;

use Exception;
class SocialController extends Controller
{

    public function index()
    {
        return view('test-login.login');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {

        try {
            $user_info_google = Socialite::driver('google')->user();
            $user = User::where('google_id', $user_info_google->id)->first();

            if($user){
                Auth::login($user);

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
                dd('ededed');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
