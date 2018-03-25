<?php


namespace App\Http\Controllers;


use App\Contracts\IMessagesRepository;
use App\Http\Requests;
use App\Contracts\IVolunteerFormRepository;
use Illuminate\Http\Request;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use Illuminate\Support\Facades\Mail;

define('INTERFAITH_ADMINS', env('INTERFAITH_ADMINS'));

class VolunteerFormController extends Controller
{
    protected $formRepository;
    protected $messagesRepository;

    public function __construct(IVolunteerFormRepository $formRepository, IMessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
        $this->formRepository = $formRepository;
        $this->middleware('guest');
    }

    public function submit(Request $request)
    {
        $request['paper_goods'] = $request['paper_goods'] == "on" ? true : false;

        $this->validate($request, [
            'organization_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'meal_description' => 'required',
            'open_event_id' => 'required',
            'open_event_date_time' => 'required'
        ]);
         
        //$this->sendEmail($request->all());
        $this->formRepository->create($request->all());
        flash('Volunteer form submitted successfully')->success();
        return redirect('/');
    }
    
    public function sendEmail($form)
    {
        $admin_emails = explode(',', INTERFAITH_ADMINS);

        $messages = $this->messagesRepository->allContent();

        // To Interfaith
        foreach($admin_emails as $email){
            Mail::to($email)
            ->send(new VolunteerRequestEmail($form, $messages));
        }
        
        // To the Volunteer
        Mail::to($form["email"])
        ->send(new VolunteerFormEmail($form, $messages));

        return redirect('/');
    }
}