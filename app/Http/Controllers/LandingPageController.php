<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerForm;
use Illuminate\Support\Facades\Mail;

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

    /**
     */
    public function testEmail()
    {
        Mail::to('mattsmith11@u.boisestate.edu')
        ->send(new VolunteerForm());

        return redirect('/');
    }
}