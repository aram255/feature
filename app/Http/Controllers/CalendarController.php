<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon;

class CalendarController extends Controller
{
     public  function index()
     {
         $event = new Event;

         $event->name = 'A new event';
         $event->startDateTime = Carbon\Carbon::now();
         $event->endDateTime = Carbon\Carbon::now()->addHour();
         $event->save();

        // $a = Event::get();

        // dd(Event::get());



        // return view('calendar');

//         foreach ($a as $val)
//         {
//             echo '<pre>';
//             echo($val->htmlLink);
//             echo '<pre>';
//         }

       //  print_r($a->htmlLink);


     }
}
