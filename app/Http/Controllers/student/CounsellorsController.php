<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Models\counsellor;
use App\Models\TimeSlots;
use Carbon\Carbon;
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

        // Initialize a query for counsellors
        $query = Counsellor::query();

        // Filter by gender if specified
        if ($gender) {
            $query->where('gender', $gender);
        }

        // Filter by date in the related 'timeSlots' model if specified
        if ($date) {
            $query->whereHas('timeSlots', function ($q) use ($date) {
                // Parse the date from the request and ensure it's in the proper format
                $parsedDate = Carbon::createFromFormat('Y-m-d', $date); // Expecting date format as 'Y-m-d'

                // Check if the date is valid, then filter based on availability
                $q->whereDate('date', $parsedDate)
                  ->whereDoesntHave('bookings');  // Ensure time slot is not booked
            });
        }

        // Fetch paginated counsellors (3 per page)
        $counsellors = $query->paginate(3);

        // Find the next available time slot for each counsellor
        foreach ($counsellors as $counsellor) {
            $now = now(); // Current time in the app's time zone (ensure this is configured correctly)

            $nextAvailableSlot = $counsellor->timeSlots()
                ->whereDoesntHave('bookings') // Ensure the time slot is not booked
                ->where(function ($q) use ($now) {
                    // Check for future dates
                    $q->where('date', '>', $now->toDateString()) // For future dates
                      ->orWhere(function ($q) use ($now) {
                          // For today's date, only select time slots after the current time
                          $q->whereDate('date', $now->toDateString())
                            ->whereTime('time', '>', $now->toTimeString());
                      });
                })
                ->orderBy('date')
                ->orderBy('time')
                ->first();

            // Format the next available time slot if it exists
            if ($nextAvailableSlot) {
                $counsellor->nextAvailableSlot = [
                    'date' => Carbon::parse($nextAvailableSlot->date)->format('M d, Y'), // Format date
                    'time' => Carbon::parse($nextAvailableSlot->time)->format('h:i A'),  // Format time
                ];
            } else {
                $counsellor->nextAvailableSlot = null; // No available slot found
            }
        }

        // Prepare the calendar events for FullCalendar
        $calendarEvents = [];
        foreach ($counsellors as $counsellor) {
            foreach ($counsellor->timeSlots as $slot) {
                // Format start time and end time properly
                $startDateTime = Carbon::parse($slot->date)->format('Y-m-d') . 'T' . Carbon::parse($slot->time)->format('H:i:s');
                $endDateTime = Carbon::parse($slot->date)->format('Y-m-d') . 'T' . Carbon::parse($slot->time)->addHour()->format('H:i:s');

                // Push event details to the calendarEvents array
                $calendarEvents[] = [
                    'title' => $counsellor->name,  // Use the counsellor's name for the event title
                    'start' => $startDateTime,      // Correctly formatted start time
                    'end' => $endDateTime,          // Correctly formatted end time
                    'className' => $slot->bookings()->exists() ? 'bg-danger' : 'bg-success',  // Red if booked, green if available
                ];
            }
        }

        // Pass counsellors, time slots, and the selected date to the view
        return view('counsellors.index', [
            'counsellors' => $counsellors,
            'time_slots' => TimeSlots::all(),  // Fetch all time slots
            'selectedDate' => $date,  // Pass the selected date to the view
            'calendarEvents' => $calendarEvents,  // Pass the calendar events for FullCalendar
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


    public function show($counsellor, Request $request)
    {
        // Retrieve all counsellors
$counsellors = Counsellor::all();

// Find the index of the selected counsellor using counsellor_id
$index = array_search($counsellor, array_column(json_decode($counsellors, true), 'counsellor_id'));

// If the counsellor is not found, show a 404 page
if ($index === false) {
    abort(404);
}


// Get the current date
$currentDate = Carbon::now()->format('Y-m-d');

// Retrieve available dates for the selected counsellor, only future dates including today
$availableDates = DB::table('time_slots')
    ->select('date')
    ->where('counsellor_id', $counsellor)
    ->where('date', '>=', $currentDate) // Only include dates today or in the future
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->pluck('date');

// If no dates are available, set the available timeslots to null
$availableTimeslots = collect();
$selectedDate = $availableDates->first(); // Default to first available date

if ($availableDates->isNotEmpty()) {
    // Get the selected date from the request, default to the first available date
    $selectedDate = $request->input('date', $availableDates->first());

    // Get the current date and time
    $currentDate = Carbon::now()->format('Y-m-d');
    $currentTime = Carbon::now()->format('H:i:s');

    // Retrieve available timeslots for the selected date
    $availableTimeslots = DB::table('time_slots')
        ->leftJoin('booking_details', 'time_slots.timeslot_id', '=', 'booking_details.timeslot_id')
        ->where('time_slots.counsellor_id', $counsellor)
        ->where('time_slots.date', $selectedDate)
        ->whereNull('booking_details.timeslot_id') // Filter out booked timeslots
        ->where(function ($query) use ($selectedDate, $currentDate, $currentTime) {
            // If the selected date is today, filter times that are greater than the current time
            if ($selectedDate === $currentDate) {
                $query->where('time_slots.time', '>', $currentTime);
            }
        })
        ->select('time_slots.timeslot_id', 'time_slots.counsellor_id', 'time_slots.date', 'time_slots.time', 'time_slots.created_at', 'time_slots.updated_at')
        ->orderBy('time', 'asc')
        ->get();
}

return view('counsellors.show', [
    'counsellor' => $counsellors[$index],
    'timeslots' => $availableTimeslots,
    'selectedDate' => $selectedDate, // Pass the selected date to the view
    'availableDates' => $availableDates, // Pass available dates to the view
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