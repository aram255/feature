<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\AuthPractitionersModel;
use Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token) {

     return view('customauth.passwords.reset', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {

      $request->validate([
          'email' => 'required|email',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',

      ]);

      $CheckEmail = DB::table('practitioner')->select('email')->where("email", $request->email)->first();
      if (isset($CheckEmail)) {


          $updatePassword = DB::table('password_resets')
              ->where(['email' => $request->email, 'token' => $request->token])
              ->first();

          if (!$updatePassword)

              return back()->withInput()->with('error', 'Invalid token!');

          $user = AuthPractitionersModel::where('email', $request->email)
              ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email' => $request->email])->delete();

          return redirect(app()->getLocale() . '/login-practitioners')->with('success', 'Your password has been changed!');

      }else{

          return back()->with('error', 'Your email empty');
      }
  }
}
