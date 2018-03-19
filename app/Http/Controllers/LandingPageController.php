<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use App\Services\CalendarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingPageController extends Controller
{

    /**
     * Show the application dashboard./
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Calendar $calendar, CalendarRepository $calendarRepository)
    {
       // $events = array_merge($calendar->findVolunteerEvents(), $calendar->findAllAccepted());

        $volunteerEvents = $calendar->findVolunteerEvents();
        $acceptedEvents = $calendar->findAllAccepted();
        $completedEvents = $calendarRepository->findAllCompleted();

        return view('welcome', ['volunteerEvents' => $volunteerEvents, 'acceptedEvents' => $acceptedEvents, 'completedEvents' => $completedEvents]);

    }

    /**
     */
}



