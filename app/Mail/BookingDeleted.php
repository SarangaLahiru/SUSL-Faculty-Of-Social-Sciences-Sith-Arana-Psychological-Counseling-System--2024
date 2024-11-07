<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @param $booking
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
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
                        'bookingDate' => $this->booking->date,
                        'bookingTime' => $this->booking->time,
                        'userName' => $this->booking->name, // Adjust based on your relations
                    ]);
    }
}