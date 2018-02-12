<?php

namespace App\Http\Controllers;

use App\Contracts\IVolunteerFormRepository;
use App\Contracts\ICalendarRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $formRepository;
    protected $calendarRepository;

    public function __construct(IVolunteerFormRepository $formRepository, ICalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
        $this->formRepository = $formRepository;
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin', ['volunteerForms' => $this->formRepository->getAllNewForms()]);
    }

    public function submit(Request $request)
    {
        
        $this->validate($request, [
            'open_event_id' => 'required',
            'volunteer_id' => 'required',
            'approve_event' => 'required'
        ]);
        if($request->approve_event)
        {
            $event = $this->formRepository->get($request->volunteer_id);

            // update the event's status in adoptameal data
            // $this->formRepository->approve($request->volunteer_id, $request->open_event_id);

            // insert the event into the accepted_events calendar
            $result = $this->calendarRepository->create($event, 'accepted');

            // remove the event from the open_events calendar
            $this->calendarRepository->delete($event->open_event_id, 'open');
        }

        else
        {
            $this->formRepository->delete($request->event_id);
        }

        return view('admin', ['volunteerForms' => $this->formRepository->getAllNewForms()]);
    }
}
