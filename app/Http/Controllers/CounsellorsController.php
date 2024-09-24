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
    public function show($counsellor)
    {
        $counsellors = counsellor::all();

        $index = array_search($counsellor, array_column(json_decode($counsellors, true), 'counsellor_id'));

        $bookingDetailsCount = DB::table('booking_details')->count();

        $timeslots = DB::table('time_slots')
            ->where('counsellor_id','=', $index+1)
            ->orderBy('time','asc')
            ->get();

        if($bookingDetailsCount > 0){
            $availableTimeslots = DB::table('time_slots')
            ->leftJoin('booking_details', 'time_slots.timeslot_id', '=', 'booking_details.timeslot_id')
            ->where('time_slots.counsellor_id', $counsellor)
            ->whereNull('booking_details.timeslot_id') // Filter out booked timeslots
            ->select('time_slots.timeslot_id', 'time_slots.counsellor_id', 'time_slots.date', 'time_slots.time', 'time_slots.created_at', 'time_slots.updated_at')
            ->orderBy('time', 'asc')
            ->get();
        }else {
            $availableTimeslots = $timeslots;
        }


        if ($index === false) {
            abort(404);
        }



        return view('counsellors.show', [
            'counsellor' => $counsellors[$index],
            'timeslots' => $availableTimeslots,
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