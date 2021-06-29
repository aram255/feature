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

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
//        $status = Password::reset(
//            $request->only( 'password', 'password_confirmation', 'token'),
//            function ($user) use ($request) {
//                $user->forceFill([
//                    'password' => Hash::make($request->password),
//                    'remember_token' => Str::random(60),
//                ])->save();
//
//                event(new PasswordReset($user));
//            }
//        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
//        return $status == Password::PASSWORD_RESET
//                    ? redirect()->route('index',[app()->getLocale()])->with('status', __($status))
//                    : back()->withInput($request->only('email'))
//                            ->withErrors(['email' => __($status)]);


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
