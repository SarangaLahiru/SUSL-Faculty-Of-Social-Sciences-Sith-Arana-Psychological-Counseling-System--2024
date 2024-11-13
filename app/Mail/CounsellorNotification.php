<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CounsellorNotification extends Mailable
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
    public $bookingRecord;
    public function __construct($formDetails, $counsellor, $specificTimeSlot, $bookingRecord)
{
    $this->formDetails = $formDetails;
    $this->counsellor = $counsellor;
    $this->specificTimeSlot = $specificTimeSlot;
    $this->bookingRecord=$bookingRecord;
}

public function build()
{
    return $this->view('emails.counsellor_notification')
                ->with([
                    'formDetails' => $this->formDetails,
                    'counsellor' => $this->counsellor,
                    'timeslot' => $this->specificTimeSlot,
                    'bookingDetails'=>$this->bookingRecord
                ]);
}
}