<?php

class EmailService {

    protected $volunteerFormRepository;
    protected $messagesRepository;

    public function __construct(IVolunteerFormRepository $volunteerFormRepository, IMessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
        $this->volunteerFormRepository = $volunteerFormRepository;
        $this->middleware('guest');
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
}