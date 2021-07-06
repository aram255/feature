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

//        $event = new Google_Service_Calendar_Event(array(
//            'summary' => 'Google I/O 2015',
//            'location' => '800 Howard St., San Francisco, CA 94103',
//            'description' => 'A chance to hear more about Google\'s developer products.',
//            'start' => array(
//                'dateTime' => '2015-05-28T09:00:00-07:00',
//                'timeZone' => 'America/Los_Angeles',
//            ),
//            'end' => array(
//                'dateTime' => '2015-05-28T17:00:00-07:00',
//                'timeZone' => 'America/Los_Angeles',
//            ),
//            'recurrence' => array(
//                'RRULE:FREQ=DAILY;COUNT=2'
//            ),
//            'attendees' => array(
//                array('email' => 'lpage@example.com'),
//                array('email' => 'sbrin@example.com'),
//            ),
//            'reminders' => array(
//                'useDefault' => FALSE,
//                'overrides' => array(
//                    array('method' => 'email', 'minutes' => 24 * 60),
//                    array('method' => 'popup', 'minutes' => 10),
//                ),
//            ),
//        ));
//
//        $calendarId = 'primary';
//        $event = $service->events->insert($calendarId, $event);
//        printf('Event created: %s\n', $event->htmlLink);

//        try {
//            $user = Socialite::driver('google')->user();
//            //dd($user);
//            $checkID = User::where('google_id', $user->id)
//                             ->where('google_id', $user->token)
//                             ->first();
//
//
//
//            if(!empty($user))
//            {
//                $Update = User::where('id', Auth::user()->id)->first();
//                $Update->google_id = $user->id;
//                $Update->google_token = $user->token;
//                $Update->save();
//
//            }


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
