<?php

namespace App\Http\Controllers;

use App\Models\counsellor;
use App\Models\TimeSlots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounsellorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gender = $request->query('gender');
        $date = $request->query('date');

        $query = Counsellor::query();

        // Filter by gender
        if ($gender) {
            $query->where('gender', $gender);
        }

        // Filter by date using the related 'timeSlots' model
        if ($date) {
            $query->whereHas('timeSlots', function ($q) use ($date) {
                $q->whereDate('date', \Carbon\Carbon::createFromFormat('m/d/Y', $date));
            });
        }

        $counsellors = $query->paginate(3);

        return view('counsellors.index', [
            'counsellors' => $counsellors,
            'time_slots' => TimeSlots::all(),
            'selectedDate' => $date, // Pass the selected date to the view
        ]);

    }

    public function deleteTimeSlot($id)
    {
        $slot = TimeSlots::find($id);
        if ($slot && !$slot->isBooked) {
            // If time slot is not booked, proceed with deletion
            $slot->delete();
            return redirect()->back()->with('success', 'Time slot deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Only available time slots can be deleted.');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($counsellor, Request $request)
{
    $counsellors = counsellor::all();

    // Find the index of the selected counsellor
    $index = array_search($counsellor, array_column(json_decode($counsellors, true), 'counsellor_id'));

    // Check if the index is valid
    if ($index === false) {
        abort(404);
    }

    // Retrieve available dates for the selected counsellor
    $availableDates = DB::table('time_slots')
        ->select('date')
        ->where('counsellor_id', $counsellor)
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->pluck('date');

    // Check if there are available dates
    if ($availableDates->isEmpty()) {
        abort(404, 'No available dates for this counsellor.');
    }

    // Get the selected date from the request, default to the first available date
    $selectedDate = $request->input('date', $availableDates->first());

    // Retrieve available timeslots based on the selected date
    $availableTimeslots = DB::table('time_slots')
        ->leftJoin('booking_details', 'time_slots.timeslot_id', '=', 'booking_details.timeslot_id')
        ->where('time_slots.counsellor_id', $counsellor)
        ->where('time_slots.date', $selectedDate)
        ->whereNull('booking_details.timeslot_id') // Filter out booked timeslots
        ->select('time_slots.timeslot_id', 'time_slots.counsellor_id', 'time_slots.date', 'time_slots.time', 'time_slots.created_at', 'time_slots.updated_at')
        ->orderBy('time', 'asc')
        ->get();

    return view('counsellors.show', [
        'counsellor' => $counsellors[$index],
        'timeslots' => $availableTimeslots,
        'selectedDate' => $selectedDate, // Pass the selected date to the view
    ]);
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
