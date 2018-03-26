<?php

namespace App\Http\Controllers;

use App\Contracts\IEmailService;
use App\Contracts\IMessagesRepository;
use App\Contracts\IVolunteerFormRepository;
use App\Contracts\ICalendarService;
use App\Contracts\IMealIdeaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use App\Utils;

class AdminController extends Controller
{

    protected $formRepository;
    protected $calendarService;
    protected $mealRepository;
    protected $messagesRepository;
    protected $emailService;

    public function __construct(IVolunteerFormRepository $formRepository, ICalendarService $calendarService, IMealIdeaRepository $mealRepository, IMessagesRepository $messagesRepository, IEmailService $emailService)
    {
        $this->calendarService = $calendarService;
        $this->formRepository = $formRepository;
        $this->mealRepository = $mealRepository;
        $this->messagesRepository = $messagesRepository;
        $this->emailService = $emailService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return view('admin', ['volunteerForms' => $this->formRepository->getAllNewForms()]);
    }

    /**
     * Show the volunteers so that the admin can edit or cancel them.
     */
    public function viewVolunteerFormsTable()
    {
        $allVolunteerForms = $this->formRepository->all();
        return view('admin-volunteerforms-table', ['volunteerforms' => $allVolunteerForms ]);
    }

    /**
     * Show the meal ideas that are in pending status and haven't been approved yet.
     */
    public function viewMealIdeas()
    {
        return view('admin-mealideas', ['mealideas' => $this->mealRepository->getNewMealIdeas()]);
    }

    /**
     * Show the meal ideas that are in the database so the admin can edit or delete them.
     */
    public function viewMealIdeasTable()
    {
        return view('admin-mealideas-table', ['mealideas' => $this->mealRepository->getConfirmedMealIdeas()]);
    }

    /**
     * Confirm a volunteer for an Adopt-A-Meal event. Create a new event in the confirmed events
     * calendar, hide the open event by setting its status to cancelled, and update the volunteer's
     * status in the database. Send an email letting the volunteer know they were approved.
     */
    public function approveVolunteer(Request $request){

        $this->validate($request, [
            'open_event_id' => 'required',
            'volunteer_id' => 'required',
        ]);

        try {

            $event = $this->formRepository->get($request->volunteer_id);
            $newEvent = $this->calendarService->create(CONFIRMED_CALENDAR_ID, $event);
            $this->calendarService->patch(CALENDAR_ID, $event->open_event_id, 'cancelled');
            $this->emailService->sendApprovalEmail($event);
            $this->formRepository->approve($request->volunteer_id, $newEvent->id);
            flash('Volunteer ' . $event->organization_name . ' was approved!')->success();

        } catch(\Exception $e) {
            flash('Couldn\'t approve volunteer. Please try again.');
        }

        return redirect('/admin');
    }

    /**
     * Deny a volunteer's request to adopt a meal. This will change their volunteer form status
     * to "denied", but won't change anything in the google calendars.
     */
    public function denyVolunteer(Request $request){
        $this->validate($request, [
            'open_event_id' => 'required',
            'volunteer_id' => 'required',
            'form_status' => 'required'
        ]);

        try {
            $this->formRepository->deny($request->volunteer_id);
            flash( "Volunteer denied.")->success();
        } catch(\Exception $e) {
            flash( "An error occured. Please try again.")->error();
        }

        return redirect('/admin');
    }

    /**
     * Cancel a confirmed volunteer event. This will remove their event from the confirmed calendar.
     * If the volunteer is the only one confirmed for that event, the open event will be "un-cancelled"
     * in the open event calendar, or "re-opened".
     */
    public function cancelVolunteer(Request $request) {
        $this->calendarService->patch(CONFIRMED_CALENDAR_ID, $request->confirmed_event_id, 'cancelled');
        if($this->formRepository->getOpenEventCount($request->open_event_id) == 1) {
            $this->calendarService->patch(CALENDAR_ID, $request->open_event_id, 'confirmed');
        } 
        $this->formRepository->cancelled($request->volunteer_id);
        flash( "Volunteer cancelled succesfully.")->success();
        return redirect('/admin/form/all');
    }

    /**
     * Update a volunteer's information with edits from an administrator.
     */
    public function updateVolunteer(Request $request){
        strtolower($request['paper_goods'][0]) == 'y' ? $request->merge(['paper_goods' => 1]) : $request->merge(['paper_goods' => 0]);
        $this->validate($request, [
            'organization_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'meal_description' => 'required',
            'open_event_id' => 'required',
            'event_date_time' => 'required',
            'paper_goods' => 'required',
            'volunteer_id' => 'required',
            'confirmed_event_id' => 'required'
        ]);

        try {
            $this->calendarService->update(CONFIRMED_CALENDAR_ID, $request);
            $this->formRepository->update($request->all(), 1);
            flash( "Volunteer updated successfully.")->success();
        } catch(\Exception $e) {
            flash( "Unable to update volunteer. Please try again.")->error();
        }

        return redirect('/admin/form/all');
    }

    /**
     * Approve a meal idea - this will display it with the other publicly available
     * meal ideas.
     */
    public function approveMealIdea(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $request['ingredients'] = json_encode(array_map(function ($val) {
            return trim($val);
        }, explode(",", $request->ingredients)));

        $this->validate($request, [
            'id' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
        ]);

        try {
            $this->mealRepository->approve($request->id, $request);
            flash("Meal Idea approved.")->success();
        } catch(\Exception $e) {
            flash("Unable to approve Meal Idea. Please try again.")->error();
        }

        return redirect()->back();
    }

    /**
     * Do not allow a meal idea to be posted with the other meal ideas.
     */
    public function denyMealIdea(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $request['ingredients'] = json_encode(array_map(function ($val) {
            return trim($val);
        }, explode(",", $request->ingredients)));

        $this->validate($request, [
            'id' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
        ]);

        try {
            $this->mealRepository->deny($request->id);
            flash("Meal Idea denied.")->success();
        } catch(\Exception $e) {
            flash("Unable to deny Meal Idea. Please try again.")->error();
        }

        return redirect()->back();
    }

    /**
     * Update a meal idea with an admin's changes.
     */
    public function updateMealIdea(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $request['ingredients'] = json_encode(array_map(function ($val) {
            return trim($val);
        }, explode(",", $request->ingredients)));

        $this->validate($request, [
            'id' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
        ]);

        try {
            $this->mealRepository->update($request->id, $request);
            flash( "Meal Idea updated.")->success();

        } catch(\Exception $e) {
            flash("Unable to update Meal Idea. Please try again.")->error();
        }

        return redirect()->back();
    }


    public function deleteMealIdea(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $this->mealRepository->delete($request->id);
        flash( "Meal Idea deleted.")->success();
        return redirect()->back();
    }

    /**
     * Get a list of content for admins to view and edit. Convert titles to human-readable
     * format so they can be displayed in a list.
     */
    public function getMessages(Request $request)
    {
        // get all message objects
        $messages = $this->messagesRepository->all();

        forEach($messages as $message) {
            // change underscores to user-friendly format
            $message->type_str = Utils::transformUnderscoreText($message->type);

            // display "never" if the message hasn't been updated
            if($message->updated_at == null) {
                $message->updated_str = "Never";
            }
            else {
                $message->updated_str = date('m-d-Y', strtotime($message->updated_at));
            }

        }
        return view('messages', ['messages' => $messages]);
    }

    /**
     * Change a message's content with an admin's edits
     */
    public function updateMessage(Request $request)
    {
        // validate inputs
        $this->validate($request, [
            'id' => 'required',
            'message-content' => 'required',
        ]);
        
        // get the user id and save the message
        if(Auth::check()) {
            $userId = Auth::id();
            $input = [
                'id' => $request['id'],
                'content' => $request['message-content'],
                'user_id' => $userId
            ];
            try {
                $this->messagesRepository->update($input);
                flash( "Your message was saved successfully!")->success();
            }
            catch(\Exception $e) {
                flash("There was a problem saving your message. Please try again later.")->error();
            }
        }
        return redirect('admin/settings/change-messages');
    }

}
