<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Models\counsellor;
use App\Models\TimeSlots;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index(){

        $counsellors = counsellor::all();
        return view('welcome',[
            'counsellors' => $counsellors,
        ]);
    }

    public function aboutus(){
        return view('aboutus');
    }


    public function contactus(){
        return view('contactus');
    }
    public function calendar(){
         // Retrieve data by joining tables without using relationships

         $eventsData = DB::table('time_slots')
         ->join('counsellors', 'time_slots.counsellor_id', '=', 'counsellors.counsellor_id')
         ->leftJoin('booking_details', 'time_slots.timeslot_id', '=', 'booking_details.timeslot_id')
         ->whereNull('booking_details.timeslot_id') // Exclude timeslots that have a booking
        //  ->whereMonth('time_slots.date', now()->month) // Only current month
         ->select(
             'time_slots.date',
             'time_slots.time',
             'counsellors.full_name_with_rate as name',
             'counsellors.profile_image as avatar'
         )
         ->get()
         ->groupBy(function ($item) {
             // Group by date in 'Y-m-d' format
             return Carbon::parse($item->date)->format('Y-m-d');
         })
         ->map(function ($daySlots) {
             // Map each timeslot to the desired format
             return $daySlots->map(function ($slot) {
                 return [
                     'name' => $slot->name,
                     'time' => Carbon::parse($slot->time)->format('g:i A'),
                     'avatar' => $slot->avatar ? asset('storage/' . $slot->avatar) : 'https://via.placeholder.com/50',
                 ];
             })->toArray();
         })
         ->toArray(); // Convert to array for use in view

     // Pass the data to the view
     return view('calendar', compact('eventsData'));
    }

}