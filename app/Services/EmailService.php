<?php

namespace App\Services;

use App\Contracts\IEmailService;
use App\Contracts\IMessagesRepository;
use App\Contracts\IVolunteerFormRepository;
use App\Mail\VolunteerFormEmail;
use App\Mail\VolunteerRequestEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminApproveEmail;
use App\Mail\VolunteerApprovedEmail;

class EmailService implements IEmailService {

    protected $volunteerFormRepository;
    protected $messagesRepository;

    public function __construct(IVolunteerFormRepository $volunteerFormRepository, IMessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
        $this->volunteerFormRepository = $volunteerFormRepository;
    }

    public function sendRegistrationEmail($form){
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

    public function sendApprovalEmail($form){
        $messages = $this->messagesRepository->allContent();
        $admin_emails = explode(',', INTERFAITH_ADMINS);

        // To Interfaith
        foreach($admin_emails as $email){
            Mail::to($email)
                ->send(new AdminApproveEmail($form, $messages));
        }

        // To the Volunteer
        Mail::to($form["email"])
            ->send(new VolunteerApprovedEmail($form, $messages));
   
    }
}