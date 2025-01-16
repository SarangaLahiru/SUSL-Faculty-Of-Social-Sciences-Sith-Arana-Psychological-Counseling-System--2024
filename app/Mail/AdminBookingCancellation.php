<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminBookingCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $counsellor;
    public $timeSlot;

    public function __construct($booking, $counsellor, $timeSlot)
    {
        $this->booking = $booking;
        $this->counsellor = $counsellor;
        $this->timeSlot = $timeSlot;
    }

    public function build()
    {
        return $this->subject('Booking Cancellation Notification')
                    ->view('admin.pages.email.delete_inform_to_admin')
                    ->with([
                        'booking' => $this->booking,
                        'counsellor' => $this->counsellor,
                        'timeSlot' => $this->timeSlot,
                    ]);
    }
}
