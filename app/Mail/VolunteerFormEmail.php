<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $appURL;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->appURL = env('URL_ADMIN', '/error'); //Somehowget the environment data and look up the URL
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.volunteerformemail', ['appUrl' => $this->appURL]);
    }
}
