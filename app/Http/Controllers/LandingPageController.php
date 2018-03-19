<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use App\Services\CalendarRepository;
use App\Services\VolunteerFormRepository;
use App\Services\MessagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class LandingPageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( CalendarRepository $calendarRepository, VolunteerFormRepository $volunteerFormRepository, MessagesRepository $messagesRepository)
    {
       // $events = array_merge($calendar->findVolunteerEvents(), $calendar->findAllAccepted());

        $volunteerEvents = $calendarRepository->getVolunteerEvents();
        $acceptedEvents = $calendarRepository->getAcceptedEvents();
        $completedEvents = $volunteerFormRepository->getAllOldApprovedForms();
        $messages = $messagesRepository->allContent();


        return view('welcome', [
            'volunteerEvents' => $volunteerEvents,
            'acceptedEvents' => $acceptedEvents,
            'completedEvents' => $completedEvents,
            'messages' => $messages
        ]);

    }

    /**
     */
}

