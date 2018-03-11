<?php

namespace App\Http\Controllers;

use App\Contracts\IVolunteerFormRepository;
use App\Contracts\ICalendarRepository;
use App\Contracts\IMealIdeaRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $formRepository;
    protected $calendarRepository;
    protected $mealRepository;

    public function __construct(IVolunteerFormRepository $formRepository, ICalendarRepository $calendarRepository, IMealIdeaRepository $mealRepository)
    {
        $this->calendarRepository = $calendarRepository;
        $this->formRepository = $formRepository;
        $this->mealRepository = $mealRepository;
        $this->middleware('auth');
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

    public function viewMealIdeas()
    {
        return view('admin-mealideas', ['mealideas' => $this->mealRepository->getNewMealIdeas()]);
    }

    public function viewMealIdeasTable()
    {
        return view('admin-mealideas-table', ['mealideas' => $this->mealRepository->getConfirmedMealIdeas()]);
    }

    public function reviewVolunteerForm(Request $request)
    {
        
        $this->validate($request, [
            'open_event_id' => 'required',
            'volunteer_id' => 'required',
            'approve_event' => 'required'
        ]);
        // Approved
        if($request->approve_event)
        {
            $event = $this->formRepository->get($request->volunteer_id);
            // update the event's status in adoptameal data
            $this->formRepository->approve($request->volunteer_id, $request->open_event_id);
            // insert the event into the accepted_events calendar
            $result = $this->calendarRepository->create($event, 'accepted');
            // remove the event from the open_events calendar
            $this->calendarRepository->delete($event->open_event_id, 'open');
        }
        // Denied
        else
        {
            $this->formRepository->deny($request->volunteer_id);
        }
            return redirect('/admin');
    }

    public function reviewMealIdea(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $request['ingredients'] = json_encode(array_map(function($val) { return trim($val); }, explode(",", $request->ingredients)));
        $this->validate($request, [
            'id' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'new_status' => 'required'
        ]);
        
        // Check the new status on the request
        if($request->new_status == 1)
        {
            // Update the meal idea with any changes and approve
            $this->mealRepository->approve($request->id, $request);
        }
        // Denied
        else if ($request->new_status == 2)
        {
            $this->mealRepository->deny($request->id);
        }
        return redirect('/admin/meal-ideas');
    }
}
