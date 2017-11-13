<?php

namespace App\Http\Controllers;
use App\Calendar;

class LandingPageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Calendar $calendar)
    {
        $events = $calendar->findAll();
        return view('welcome', ['events' => $events]);
    }

}