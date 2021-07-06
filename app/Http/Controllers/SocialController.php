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
        //dd('sdsd');
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $checkID = User::where('google_id', $user->id)
                             ->where('google_id', $user->token)
                             ->first();



            if(!empty($user))
            {
                $Update = User::where('id', Auth::user()->id)->first();
                $Update->google_id = $user->id;
                $Update->google_token = $user->token;
                $Update->save();

            }


//            if($user){
//                Auth::login($user);
//                return redirect('en/login');
//            }else{
//
//                $newUser = User::create([
//                    'first_name' => $user->name,
//                    'email' => $user->email,
//                    'google_id'=> $user->id,
//                    'password' => encrypt('123456dummy')
//                ]);
//                Auth::login($newUser);
//                return redirect('en/login');
//            }
        } catch (Exception $e) {
            dd('qqqqqqqq');
            dd($e->getMessage());
        }
    }
}
