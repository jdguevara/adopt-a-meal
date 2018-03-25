<?php


namespace App\Http\Controllers;

use App\Contracts\IMessagesRepository;
use App\Contracts\IVolunteerFormRepository;
use App\Contracts\IEmailService;
use Illuminate\Http\Request;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use Illuminate\Support\Facades\Mail;

define('INTERFAITH_ADMINS', env('INTERFAITH_ADMINS'));

class VolunteerFormController extends Controller
{
    protected $formRepository;
    protected $emailService;

    public function __construct(IVolunteerFormRepository $formRepository, IEmailService $emailService)
    {
        $this->formRepository = $formRepository;
        $this->middleware('guest');
        $this->emailService = $emailService;
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
        $this->emailService->sendRegistraitonEmail($request->all());
        $this->formRepository->create($request->all());
        flash('Volunteer form submitted successfully')->success();
        return redirect('/');
    }
    
}