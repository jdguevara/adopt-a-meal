<?php

namespace App\Http\Controllers;
use App\Contracts\ICalendarService;
use App\Contracts\IVolunteerFormRepository;
use App\Contracts\IMessagesRepository;

define('OPEN_EVENT_CALENDAR', env('CALENDAR_ID'));
define('CONFIRMED_EVENT_CALENDAR', env('CONFIRMED_CALENDAR_ID'));

class LandingPageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ICalendarService $calendarService, IVolunteerFormRepository $volunteerFormRepository, IMessagesRepository $messagesRepository)
    {
        $volunteerEvents = $calendarService->fetchEvents(OPEN_EVENT_CALENDAR);
        $acceptedEvents = $calendarService->fetchEvents(CONFIRMED_EVENT_CALENDAR);
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

