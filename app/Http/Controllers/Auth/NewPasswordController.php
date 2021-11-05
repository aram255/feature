<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthPractitionersModel;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use DB;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('customer.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);


        $CheckEmail = DB::table('users')->select('email')->where("email", $request->email)->first();
        if (isset($CheckEmail)) {


            $updatePassword = DB::table('password_resets')
                ->where(['email' => $request->email, 'token' => $request->token])
                ->first();

            if (!$updatePassword)

                return back()->withInput()->with('error', 'Invalid token!');

            $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email' => $request->email])->delete();

            return redirect(app()->getLocale())->with('success', 'Your password has been changed!');

        }else{

            return back()->with('error', 'Your email empty');
        }
    }
}
