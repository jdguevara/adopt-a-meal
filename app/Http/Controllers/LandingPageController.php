<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use App\Services\MessagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingPageController extends Controller
{

    /**
     * Show the Volunteer Calendar and events
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Calendar $calendar, MessagesRepository $messagesRepository)
    {
        $volunteerEvents = $calendar->findVolunteerEvents();
        $acceptedEvents = $calendar->findAllAccepted();
        $messages = $messagesRepository->allContent();

        return view('welcome', [
            'volunteerEvents' => $volunteerEvents,
            'acceptedEvents' => $acceptedEvents,
            'messages' => $messages
        ]);
    }
}