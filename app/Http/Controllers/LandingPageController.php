<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use App\Services\CalendarRepository;
use App\Services\VolunteerFormRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingPageController extends Controller
{

    /**
     * Show the application dashboard./
     *
     * @return \Illuminate\Http\Response
     */
    public function index( CalendarRepository $calendarRepository, VolunteerFormRepository $volunteerFormRepository)
    {
       // $events = array_merge($calendar->findVolunteerEvents(), $calendar->findAllAccepted());

        $volunteerEvents = $calendarRepository->getVolunteerEvents();
        $acceptedEvents = $calendarRepository->getAcceptedEvents();
        $completedEvents = $volunteerFormRepository->getAllOldApprovedForms();

        return view('welcome', ['volunteerEvents' => $volunteerEvents, 'acceptedEvents' => $acceptedEvents, 'completedEvents' => $completedEvents]);

    }

    /**
     */
}



