<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookedTime extends Mailable
{
    use Queueable, SerializesModels;

    public $formDetails;
    public $counsellor;
    public $specificTimeSlot;
    public $pdf;
    public function __construct($formDetails, $counsellor, $specificTimeSlot)
{
    $this->formDetails = $formDetails;
    $this->counsellor = $counsellor;
    $this->specificTimeSlot = $specificTimeSlot;
    // $this->pdf = $pdf;
}
    public function build()
    {
        return $this
            ->from('sumalsurendra1999@gmail.com')
            ->subject('You have a booking!')
            ->view('emails.booked_timeslots')
            ->with([
                'formDetails' => $this->formDetails,
                'counsellor' => $this->counsellor,
                'timeslot' => $this->specificTimeSlot
            ]);
            // ->attachData($this->pdf->output(), 'booking_confirmation.pdf', [
            //     'mime' => 'application/pdf',
            // ]);

    }
}