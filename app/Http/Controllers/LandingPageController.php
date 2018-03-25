<?php

namespace App\Http\Controllers;
use App\Contracts\ICalendarService;
use App\Contracts\IVolunteerFormRepository;
use App\Contracts\IMessagesRepository;

class LandingPageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ICalendarService $calendarRepository, IVolunteerFormRepository $volunteerFormRepository, IMessagesRepository $messagesRepository)
    {
        $volunteerEvents = $calendarRepository->getVolunteerEvents();
        $acceptedEvents = $calendarRepository->getConfirmedEvents();
        $completedEvents = $volunteerFormRepository->getAllPreviousAcceptedOrganizationNames();
        $messages = $messagesRepository->allContent();


        return view('welcome', [
            'volunteerEvents' => $volunteerEvents,
            'acceptedEvents' => $acceptedEvents,
            'completedEvents' => $completedEvents,
            'messages' => $messages
        ]);

    }
}

