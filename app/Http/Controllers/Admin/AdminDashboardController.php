<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetails;
use App\Models\Counsellor;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $counsellors = Counsellor::all();
        return view('admin.pages.counsellors', compact('counsellors'));
        // return view('admin.pages.counsellors'); // Create this view
    }
    public function bookings()
    {




  // Fetch booking details with counsellor's name and time slot information
  $bookings = BookingDetails::with(['counsellor', 'timeSlot'])->get();


        return view('admin.pages.bookings',compact('bookings')); // Create this view
    }
    public function counsellors()
    {
        $counsellors = Counsellor::all();
        return view('admin.pages.counsellors', compact('counsellors'));
    }


    public function destroy($id)
    {
        // Find the booking by ID
        $booking = BookingDetails::findOrFail($id);

        // Delete the booking
        $booking->delete();

        // Redirect back with a success message
        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully.');
    }


}