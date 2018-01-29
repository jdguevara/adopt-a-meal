<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
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
       // $events = array_merge($calendar->findVolunteerEvents(), $calendar->findAllAccepted());

        $volunteerEvents = $calendar->findVolunteerEvents();
        $acceptedEvents = $calendar->findAllAccepted();

        return view('welcome', ['volunteerEvents' => $volunteerEvents, 'acceptedEvents' => $acceptedEvents]);
    }

    /**
     */
    public function testEmail()
    {
        Mail::to('mergeconflictscs471-group@u.boisestate.edu')
        ->send(new VolunteerFormEmail());

        Mail::to('mergeconflictscs471-group@u.boisestate.edu')
        ->send(new VolunteerRequestEmail());

        return redirect('/');
    }
}