<?php

namespace App\Http\Controllers;

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

        $counsellor = counsellor::where('counsellor_id', $counsellor_id)->first();

        $timeslot_id = $request->query('timeslot');

        $specificTimeSlot = TimeSlots::where('timeslot_id', $timeslot_id)->first();


        $request->validate([
            'mobile-no' => 'required',
            'email' => ['required','email'],
            'faculty' => 'required',
        ]);

        $formDetails = [
            'mobile_no' => $request->input('mobile-no'),
            'email' => $request->input('email'),
            'faculty' => $request->input('faculty'),
            'name' => $request->input('name'),
            'registration_no' => $request->input('registration_no'),
            'message' => $request->input('message'),
        ];

        // Mail::to('sumalsurendrasammu@gmail.com')->send(new BookedTime($formDetails));

        $bookingrecord = new BookingDetails();

        $bookingrecord->timeslot_id = $timeslot_id;

        $bookingrecord->save();

        $bookingdetail = BookingDetails::where('timeslot_id', $timeslot_id)->first();


        return view('emails.invoice',[
            'counsellor' => $counsellor,
            'timeslot' => $specificTimeSlot,
            'bookingdetail' => $bookingdetail,
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
        //
    }
}