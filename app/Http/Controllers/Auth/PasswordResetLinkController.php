<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use DB;
use Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);


        $token = Str::random(64);
        $CheckEmail =  DB::table('users')->select('email')->where("email",$request->email)->first();

        if(isset($CheckEmail))
        {
            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            Mail::send('customer.verify',['token' => $token], function($message) use ($request) {
                $message->from($request->email);
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });

            return redirect(app()->getLocale())->with('success', 'We have e-mailed your password reset link!');
        }else{
            return back()->with('status', 'No reset link!');
        }
    }
}
