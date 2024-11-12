<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $TimeSlot;
    public $booking;
    public $counsellor;

    /**
     * Create a new message instance.
     *
     * @param $booking
     */
    public function __construct($booking , $counsellor , $TimeSlot)
    {
        $this->counsellor = $counsellor;
        $this->booking = $booking;
        $this->TimeSlot = $TimeSlot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Deleted Notification')
                    ->view('admin.pages.email.booking_deleted')
                    ->with([
                        'bookingDate' => $this-> TimeSlot->date,
                        'bookingTime' => Carbon::parse($this->TimeSlot->time)->format('h:i A'),
                        'userName' => $this->booking->name, // Adjust based on your relations
                        'counsellor' => $this->counsellor,
                    ]);
    }
}