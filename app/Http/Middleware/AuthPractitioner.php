<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use session;

class AuthPractitioner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Session::has('UserID')) {
            if ($request->segment(2) == "login-practitioners" || $request->segment(2) == "register-practitioners") {
                return redirect(app()->getLocale() . "/profile-practitioner");
            }
        }

        return $next($request);

    }
}
