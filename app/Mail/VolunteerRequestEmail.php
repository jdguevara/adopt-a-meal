<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $appURL;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->appURL = env("APP_URL") . env('URL_ADMIN', '/error');
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.volunteerrequestemail', ['appUrl' => $this->appURL, 'form' => $this->form]);
    }
}
