<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Models\counsellor;
use App\Models\Feedback;
use App\Models\TimeSlots;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index(){
        $testimonials = Feedback::where('is_published', true)->get();
    return view('welcome', compact('testimonials'));
    }

    public function aboutus(){
        return view('aboutus');
    }


    public function contactus(){
        return view('contactus');
    }
    public function calendar(){
         // Retrieve data by joining tables without using relationships
         $now = Carbon::now();


$now = Carbon::now();

$eventsData = DB::table('time_slots')
    ->join('counsellors', 'time_slots.counsellor_id', '=', 'counsellors.counsellor_id')
    ->leftJoin('booking_details', 'time_slots.timeslot_id', '=', 'booking_details.timeslot_id')
    ->where(function ($query) use ($now) {
        $query->where('time_slots.date', '>', $now->toDateString())
              ->orWhere(function ($query) use ($now) {
                  $query->where('time_slots.date', '=', $now->toDateString())
                        ->where('time_slots.time', '>', $now->toTimeString());
              });
    })
    ->select(
        'time_slots.date',
        'time_slots.time',
        'counsellors.full_name_with_rate as name',
        'counsellors.profile_image as avatar',
        'booking_details.timeslot_id as booking_id' // Check if a booking exists
    )
    ->get()
    ->groupBy(function ($item) {
        return Carbon::parse($item->date)->format('Y-m-d');
    })
    ->map(function ($daySlots) {
        return $daySlots->map(function ($slot) {
            return [
                'name' => $slot->name,
                'time' => Carbon::parse($slot->time)->format('g:i A'),
                'status' => $slot->booking_id ? 'booked' : 'available', // Mark as "booked" or "available"
                'avatar' => $slot->avatar ? asset('storage/' . $slot->avatar) : 'https://via.placeholder.com/50',
            ];
        })->toArray();
    })
    ->toArray();// Convert to array for use in view

     // Pass the data to the view
     return view('calendar', compact('eventsData'));
    }

}