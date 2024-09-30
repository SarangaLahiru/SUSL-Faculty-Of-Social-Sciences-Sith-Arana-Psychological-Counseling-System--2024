<?php

namespace App\Http\Controllers\Counsellor\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BookingDetails;
use App\Models\Counsellor;
use App\Models\TimeSlots;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CounsellorAuthController extends Controller
{
    public function loginForm()
    {
        return view('counsellors.auth.login');
    }

    public function dashboard()
{
     // Get the currently authenticated counsellor
     $counsellor = Auth::guard('counsellor')->user();

     // Retrieve the counsellor's bookings along with the related timeslots
     $bookings = BookingDetails::with('timeSlot') // Ensure relation name is correct in the model
     ->where('counsellor_id', $counsellor->counsellor_id) // Use counsellor_id, not id
     ->get();

     // Pass the bookings to the dashboard view
     return view('counsellors.dashboard.pages.dashboard', compact('bookings','counsellor'));
}
public function profile()
{
     // Get the currently authenticated counsellor
     $counsellor = Auth::guard('counsellor')->user();

     // Pass the bookings to the dashboard view
     return view('counsellors.dashboard.pages.profile', compact('counsellor'));
}
public function availability()
{
    // Get the currently authenticated counsellor
    $counsellor = Auth::guard('counsellor')->user();

    // Retrieve the counsellor's bookings along with the related timeslots
    $bookings = BookingDetails::with('timeSlot') // Ensure relation name is correct in the model
        ->where('counsellor_id', $counsellor->counsellor_id) // Use counsellor_id, not id
        ->get();

    // Retrieve all time slots for the counsellor
    $timeSlots = TimeSlots::where('counsellor_id', $counsellor->counsellor_id)->get();

    // Create an array to categorize booked and available time slots
    $availability = [];

    foreach ($timeSlots as $slot) {
        // Check if the current slot is booked
        $isBooked = $bookings->contains('timeslot_id', $slot->timeslot_id);

        // Add the slot to the availability array
        $availability[] = [
            'time_slot_id'=>$slot->timeslot_id,
            'date' => $slot->date, // Assuming you have a date field in your time slots
            'time' => $slot->time, // Assuming you have a time field in your time slots
            'isBooked' => $isBooked,
        ];
    }

    // Pass the availability to the view
    return view('counsellors.dashboard.pages.availability', compact('availability','counsellor'));
}

public function editDetails()
{
     // Get the currently authenticated counsellor
     $counsellor = Auth::guard('counsellor')->user();


     return view('counsellors.dashboard.pages.editDetails', compact('counsellor'));
}

    public function login(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'NIC' => 'required|string|min:6',
        'password' => 'required|string|min:6',
    ]);

    // If validation fails, redirect back with errors
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('NIC', 'password');

    // Attempt to log the user in using the counsellor guard
    if (Auth::guard('counsellor')->attempt($credentials)) {
        return redirect()->route('counsellor.dashboard'); // Redirect to the dashboard

    }

    // If authentication fails, return back with an error message
    return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
}

    public function logout()
    {
        Auth::guard('counsellor')->logout();
        return redirect()->route('counsellor.loginForm');
    }


public function update(Request $request, $id)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'phone' => 'required|string|max:15',
        'title' => 'nullable|string|max:100',
        'gender' => 'nullable|in:male,female',
        'bio' => 'nullable|string|max:1000',
         'specializations.*' => 'nullable|string|max:100', // Validate each specialization
        'languages.*' => 'nullable|string|max:100',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File validation
    ]);

    // Find the counsellor by ID
    $counsellor = Counsellor::findOrFail($id);

    // Update counsellor details
    $counsellor->full_name_with_rate = $request->input('name');
    $counsellor->email = $request->input('email');
    $counsellor->mobile_no = $request->input('phone');
    $counsellor->title = $request->input('title');
    $counsellor->gender = $request->input('gender');
    $counsellor->bio = $request->input('bio');
    // Handle specializations
    $counsellor->specializations = $request->input('specializations', []); // Assuming you have a column for this in your database

    // Handle languages
    $counsellor->languages = $request->input('languages', []);

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        // Delete the old profile image if it exists
        if ($counsellor->profile_image) {
            Storage::delete('public/' . $counsellor->profile_image);
        }

        // Store the new profile image
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $counsellor->profile_image = $imagePath;
    }

    // Save the updated counsellor data to the database
    $counsellor->save();

    return redirect()->route('counsellor.profile')->with('success', 'Profile updated successfully!');
}


public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'date.*' => 'required|date',
        'time.*' => 'required|date_format:H:i',
    ]);

    $counsellorId = Auth::guard('counsellor')->user()->counsellor_id;

    // Loop through the date and time arrays
    for ($i = 0; $i < count($request->date); $i++) {
        $date = $request->date[$i];
        $time = $request->time[$i];

        // Check if the slot already exists for the counsellor
        $existingSlot = TimeSlots::where('counsellor_id', $counsellorId)
                        ->where('date', $date)
                        ->where('time', $time)
                        ->first();

        if ($existingSlot) {
            return redirect()->back()->with('error', 'One or more time slots already exist.');
        }

        // Store the new time slot
        TimeSlots::create([
            'counsellor_id' => $counsellorId,
            'date' => $date,
            'time' => $time,
            'isBooked' => false, // Initially, the slot is available
        ]);
    }

    return redirect()->back()->with('success', 'Time slots added successfully.');
}

}