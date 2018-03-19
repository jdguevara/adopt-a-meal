<?php

namespace App\Http\Controllers;

use App\Contracts\IMessagesRepository;
use App\Contracts\IVolunteerFormRepository;
use App\Contracts\ICalendarRepository;
use App\Contracts\IMealIdeaRepository;
use App\Mail\AdminApproveEmail;
use App\Mail\VolunteerApprovedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
define('INTERFAITH_ADMINS', env('INTERFAITH_ADMINS'));
use http\Exception;
use Illuminate\Support\Facades\Auth;
use App\Utils;

class AdminController extends Controller
{

    protected $formRepository;
    protected $calendarRepository;
    protected $mealRepository;
    protected $messagesRepository;

    public function __construct(IVolunteerFormRepository $formRepository, ICalendarRepository $calendarRepository, IMealIdeaRepository $mealRepository, IMessagesRepository $messagesRepository)
    {

        $this->calendarRepository = $calendarRepository;
        $this->formRepository = $formRepository;
        $this->mealRepository = $mealRepository;
        $this->messagesRepository = $messagesRepository;
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

    public function viewVolunteerFormsTable()
    {
        return view('admin-volunteerforms-table', ['volunteerforms' => $this->formRepository->all()]);
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
        if ($request->approve_event) {

            $event = $this->formRepository->get($request->volunteer_id);
            // update the event's status in adoptameal data
            $this->formRepository->approve($request->volunteer_id, $request->open_event_id);
            $this->sendEmail($event);
            // insert the event into the accepted_events calendar
            $result = $this->calendarRepository->create($event, 'accepted');
            // remove the event from the open_events calendar

            $this->calendarRepository->delete($event->open_event_id, 'open');

        } // Denied
        else {
            $this->formRepository->deny($request->volunteer_id);
        }
        return redirect('/admin');
    }

    public function reviewMealIdea(Request $request)
    {
        $request['display'] = $request['display'] == "on" ? true : false;
        $request['ingredients'] = json_encode(array_map(function ($val) {
            return trim($val);
        }, explode(",", $request->ingredients)));
        $this->validate($request, [
            'id' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'new_status' => 'required'
        ]);

        // Check the new status on the request
        if ($request->new_status == 1) {
            // Update the meal idea with any changes and approve
            $this->mealRepository->approve($request->id, $request);
        } // Denied
        else if ($request->new_status == 2) {
            $this->mealRepository->deny($request->id);
        }
        return redirect()->back();
    }


    public function sendEmail($form)
    {
        $admin_emails = explode(',', INTERFAITH_ADMINS);

        // To Interfaith
        foreach($admin_emails as $email){
            Mail::to($email)
                ->send(new AdminApproveEmail($form));
        }

        // To the Volunteer
        Mail::to($form["email"])
            ->send(new VolunteerApprovedEmail($form));

        return redirect('/');
    }

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

            catch(Exception $e) {
                flash("There was a problem saving your message. Please try again later.")->error();
            }

        }

        return redirect('admin/settings/change-messages');
    }

}