<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;


class VolunteerApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $messages)
    {
        $this->form = $form;
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->form['event_date_time'] = Carbon::parse($this->form['event_date_time'])->format('Y-m-d');
        return $this->view('emails.volunteerapprovedemail', [ 'form' => $this->form, 'messages' => $this->messages ]);
    }
}
