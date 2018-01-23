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
        $events = $calendar->findAll();
        $accepted = $calendar->findAllAccepted();
        echo('<pre>');
        print_r($accepted);
        echo('</pre>');
        return view('welcome', ['events' => $events]);
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