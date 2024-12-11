<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $formDetails;
    public $counsellor;
    public $specificTimeSlot;
    public $pdf;
    public function __construct($formDetails, $counsellor, $specificTimeSlot,$pdf)
{
    $this->formDetails = $formDetails;
    $this->counsellor = $counsellor;
    $this->specificTimeSlot = $specificTimeSlot;
    $this->pdf = $pdf;
}


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->markdown('emails.booking_confirmation')
                    ->with([
                        'formDetails' => $this->formDetails,
                        'counsellor' => $this->counsellor,
                        'timeslot' => $this->specificTimeSlot
                    ])
                     ->attachData($this->pdf->output(), 'booking_confirmation.pdf', [
                 'mime' => 'application/pdf',
             ]);
    }
}