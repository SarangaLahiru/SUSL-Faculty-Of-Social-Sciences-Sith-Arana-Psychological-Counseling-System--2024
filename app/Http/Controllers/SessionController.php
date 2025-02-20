<?php

namespace App\Http\Controllers;

// Adjust the model name if necessary

use App\Mail\BookingConfirmationMail;
use App\Mail\AdminBookingCancellation;
use App\Mail\BookingDeleted;
use App\Models\BookingDetails;
use App\Models\Counsellor;
use App\Models\TimeSlots;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

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

          // Generate PDF from view
          $pdf = Pdf::loadView('pdf.booking_confirmation', [
            'formDetails' => $booking,
            'counsellor' => $counsellor,
            'timeslot' => $TimeSlot,
            'bookingDate' => Carbon::now()->format('F d, Y'), // Current date
            'bookingTime' => Carbon::now()->format('h:i A'),
            'bookingID' => $booking->booking_id,
            'location' => 'Sitharana Counseling Center, SUSL'
        ]);
        $pdfPath = storage_path('app/public/booking_confirmation.pdf');
        $pdf->save($pdfPath);



        // Delete the booking
        Mail::to($userEmail)->send(new BookingConfirmationMail($booking, $counsellor, $TimeSlot,$pdf));



        return redirect()->route('counsellor.loginForm')
            ->with('confirm', 'Session confirmed successfully.');
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

        Mail::to('sitharana@ssl.sab.ac.lk')->send(new AdminBookingCancellation($booking, $counsellor, $TimeSlot));



        return redirect()->route('counsellor.loginForm')
            ->with('reject', 'Session canceled successfully.');
    }
}