<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function getEmail()
  {
     return view('customauth.passwords.email');
  }

 public function postEmail(Request $request)
  {
    $request->validate([
        'email' => 'required|email',
    ]);



    $token = Str::random(64);
    $CheckEmail =  DB::table('practitioner')->select('email')->where("email",$request->email)->first();

        if(isset($CheckEmail))
        {
            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );


            Mail::send('customauth.verify',['token' => $token], function($message) use ($request) {
                $message->from($request->email);
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });

            return back()->with('success', 'We have e-mailed your password reset link!');
        }else{
            return back()->with('status', 'No reset link!');
        }

  }
}
