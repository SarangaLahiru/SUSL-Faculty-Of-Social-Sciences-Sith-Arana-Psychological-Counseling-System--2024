<?php

namespace App\Http\Controllers;

// Adjust the model name if necessary

use App\Mail\BookingConfirmationMail;
use App\Mail\BookingDeleted;
use App\Models\BookingDetails;
use App\Models\Counsellor;
use App\Models\TimeSlots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{
    // Confirm session
    public function confirmSession($timeslotId)
    {
        // Find the timeslot by ID and update the status to confirmed
        $booking = BookingDetails::findOrFail($timeslotId);

        // Capture the email and other necessary info before deleting the booking
        $userEmail = $booking->email; // Adjust based on your relations

        $counsellor = Counsellor::where('counsellor_id', $booking->counsellor_id)->first();

        $TimeSlot = TimeSlots::where('timeslot_id',$booking->timeslot_id)->first();

        // Delete the booking
        Mail::to($userEmail)->send(new BookingConfirmationMail($booking, $counsellor, $TimeSlot));



        return redirect()->route('home.index')
            ->with('success', 'Session confirmed successfully.');
    }

    // Cancel session
    public function deleteSession($timeslotId)
    {
        // Find the timeslot by ID and update the status to canceled
        // $timeslot = TimeSlots::findOrFail($timeslotId);
        // $timeslot->status = 'canceled'; // Adjust the field name as needed
        // $timeslot->save();



        $booking = BookingDetails::findOrFail($timeslotId);

        // Capture the email and other necessary info before deleting the booking
        $userEmail = $booking->email; // Adjust based on your relations

        // Delete the booking
        $booking->delete();
        $counsellor = Counsellor::where('counsellor_id', $booking->counsellor_id)->first();

        $TimeSlot = TimeSlots::where('timeslot_id',$booking->timeslot_id)->first();

        // Send the email notification
        Mail::to($userEmail)->send(new BookingDeleted($booking,$counsellor  ,  $TimeSlot));


        return redirect()->route('home.index')
            ->with('success', 'Session canceled successfully.');
    }
}