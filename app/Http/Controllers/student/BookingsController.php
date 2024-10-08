<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Mail\BookedTime;
use App\Models\BookingDetails;
use App\Models\counsellor;
use App\Models\TimeSlots;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Node\Specificity;
use \Illuminate\Support\Facades\Mail;

use function PHPSTORM_META\type;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($counsellor_id, Request $request)
    {

        $counsellor = counsellor::where('counsellor_id', $counsellor_id)->first();

        $timeslot_id = $request->query('timeslot_id');

        $timeslots = TimeSlots::all();

        $specificTimeSlot = $timeslots->firstWhere('timeslot_id', $timeslot_id);


        return view('counsellors.bookings.create',[
            'counsellor' => $counsellor,
            'timeslot' => $specificTimeSlot,

        ]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $counsellor_id)
{
    // Retrieve the counsellor and timeslot from the database
    $counsellor = Counsellor::where('counsellor_id', $counsellor_id)->first();
    $timeslot_id = $request->query('timeslot');
    $specificTimeSlot = TimeSlots::where('timeslot_id', $timeslot_id)->first();

    // Validate request inputs with custom error messages
    $validatedData = $request->validate([
        'mobile-no' => 'required|digits_between:10,15', // Validate mobile number to be between 10-15 digits
        'email' => 'required|email', // Validate email
        'faculty' => 'required', // Ensure faculty is selected
        'name' => 'nullable|string|max:255', // Name is optional
        'registration_no' => 'nullable|string|max:20', // Registration number is optional
        'message' => 'nullable|string|max:1000', // Optional message with a max of 1000 characters
    ], [
        'mobile-no.required' => 'Please provide your mobile number.',
        'mobile-no.digits_between' => 'Mobile number must be between 10 and 15 digits.',
        'email.required' => 'Your email is required.',
        'email.email' => 'Please enter a valid email address.',
        'faculty.required' => 'Please select your faculty.',
    ]);

    // Prepare form details for email or future use
    $formDetails = [
        'mobile_no' => $validatedData['mobile-no'],
        'email' => $validatedData['email'],
        'faculty' => $validatedData['faculty'],
        'name' => $validatedData['name'] ?? null, // Optional field
        'registration_no' => $validatedData['registration_no'] ?? null, // Optional field
        'message' => $validatedData['message'] ?? null, // Optional field
    ];

    // Create a new booking record
    $bookingRecord = new BookingDetails();
    $bookingRecord->counsellor_id = $counsellor->counsellor_id;
    $bookingRecord->timeslot_id = $timeslot_id;
    $bookingRecord->mobile_no = $formDetails['mobile_no'];
    $bookingRecord->email = $formDetails['email'];
    $bookingRecord->faculty = $formDetails['faculty'];
    $bookingRecord->name = $formDetails['name'];
    $bookingRecord->registration_no = $formDetails['registration_no'];
    $bookingRecord->message = $formDetails['message'];

    $bookingRecord->save();

    // Optionally, send an email confirmation
    Mail::to($formDetails['email'])->send(new BookedTime($formDetails));

    // Retrieve the saved booking details
    $bookingDetail = BookingDetails::where('timeslot_id', $timeslot_id)->first();

    // Return view with booking details
    return view('emails.invoice', [
        'counsellor' => $counsellor,
        'timeslot' => $specificTimeSlot,
        'bookingDetail' => $bookingDetail,
    ]);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the booking by ID
        $booking = BookingDetails::findOrFail($id);

        // Delete the booking
        $booking->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}
