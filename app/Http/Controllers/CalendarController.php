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



     }
}
