<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookedTime extends Mailable
{
    use Queueable, SerializesModels;

    public $formDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formDetails)
    {
        $this->formDetails = $formDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('sumalsurendra1999@gmail.com')
            ->subject('You have a booking!')
            ->view('emails.booked_timeslots')
            ->with('formDetails', $this->formDetails);;
    }
}
