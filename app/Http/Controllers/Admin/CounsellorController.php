<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counsellor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\CounsellorCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CounsellorController extends Controller
{
    //
    // Show the form to create a new counsellor
    public function index()
    {
        $counsellors = Counsellor::all();
        return view('admin.pages.counsellors', compact('counsellors'));
    }


    public function create()
    {
        return view('admin.pages.create_counsellor');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name_with_rate' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:counsellors',
            'NIC' => 'required|string|min:6|unique:counsellors',
            'time_slots.*.day_of_week' => 'required|string',
            'time_slots.*.time' => 'required|date_format:H:i',
            'time_slots.*.duration' => 'required|integer|min:15|max:120',
            'weeks' => 'required',
        ]);

        // Generate an 8-character random password
        $generatedPassword = Str::random(8);

        // Hash the generated password
        $hashedPassword = Hash::make($generatedPassword);

        // Create the counsellor
        $counsellor = Counsellor::create([
            'full_name_with_rate' => $validatedData['full_name_with_rate'],
            'email' => $validatedData['email'],
            'NIC' => $validatedData['NIC'],
            'password' => $hashedPassword,
        ]);

        // Send email to the counsellor with their login credentials
        Mail::to($validatedData['email'])->send(new CounsellorCredentials($counsellor->email, $generatedPassword));

        // Add weekly recurring time slots for the counsellor
        $weeksToGenerate = $validatedData['weeks']; // Define how many weeks to generate the slots for
        $startDate = Carbon::now(); // Starting from the current date
        $endDate = $startDate->copy()->addWeeks($weeksToGenerate);

        foreach ($request->time_slots as $slot) {
            $dayOfWeek = $slot['day_of_week'];
            $time = $slot['time'];
            $duration = $slot['duration'];

            // Generate recurring dates for each day of the week up to the defined weeks
            $currentDate = $startDate->copy()->next($dayOfWeek); // Start on the next occurrence of the day

            while ($currentDate->lte($endDate)) {
                // Save each time slot as an individual record
                $counsellor->timeSlots()->create([
                    'date' => $currentDate->format('Y-m-d'),
                    'time' => $time,
                    'duration' => $duration,
                ]);

                // Move to the same day in the next week
                $currentDate->addWeek();
            }
        }

        return redirect()->route('admin.counsellors')->with('success', 'Counsellor added successfully with weekly time slots.');
    }


    public function edit(Request $request, $counsellor_id)
    {
        // Retrieve the counsellor using the counsellor_id
        $counsellor = Counsellor::find($counsellor_id);

        // Check if the counsellor exists
        if (!$counsellor) {
            return redirect()->route('admin.counsellors')->with('error', 'Counsellor not found.');
        }

        // Pass the counsellor object to the view
        return view('admin.pages.edit_counsellor', compact('counsellor'));
    }


    // Update the counsellor's details in the database
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post' => 'required|string',
            'intro' => 'required|string|max:200',
            'username' => 'required|string|max:100',
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
        $counsellor->intro = $request->input('intro');
        $counsellor->post = $request->input('post');
        $counsellor->username = $request->input('username');
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

        return redirect()->route('counsellorsShow.index')->with('success', 'Counsellor updated successfully.');
    }


    public function destroy($counsellor_id)
    {
        // Find the counsellor by ID
        $counsellor = Counsellor::findOrFail($counsellor_id);

        // Delete the counsellor
        $counsellor->delete();

        // Redirect with success message
        return redirect()->route('admin.counsellors')->with('success', 'Counsellor deleted successfully.');
    }

    public function deleteTimeSlotsView()
    {
        return view('counsellors.dashboard.pages.delete_time_slots');
    }

    public function deleteAllTimeSlots()
    {
        $counsellor = auth()->guard('counsellor')->user();

        if (!$counsellor) {
            return redirect()->route('counsellor.dashboard')->with('error', 'Unauthorized access.');
        }

        // Delete all time slots associated with the logged-in counsellor
        $counsellor->timeSlots()->delete();

        return redirect()->route('counsellor.dashboard')->with('success', 'All time slots deleted successfully.');
    }

    public function addTimeSlots(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'weeks' => 'required|integer|min:1|max:52',
            'time_slots.*.day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time_slots.*.time' => 'required|date_format:H:i',
            'time_slots.*.duration' => 'required|integer|min:15|max:120',
        ]);

        $counsellor = auth()->guard('counsellor')->user();

        if (!$counsellor) {
            return redirect()->route('counsellor.dashboard')->with('error', 'Unauthorized access.');
        }

        // Generate weekly recurring time slots
        $weeksToGenerate = $validatedData['weeks']; // Number of weeks
        $startDate = Carbon::now(); // Start from the current date
        $endDate = $startDate->copy()->addWeeks($weeksToGenerate);

        foreach ($request->time_slots as $slot) {
            $dayOfWeek = $slot['day_of_week'];
            $time = $slot['time'];
            $duration = $slot['duration'];

            // Generate recurring dates for each day of the week
            $currentDate = $startDate->copy()->next($dayOfWeek); // Start on the next occurrence of the day

            while ($currentDate->lte($endDate)) {
                // Save each time slot
                $counsellor->timeSlots()->create([
                    'date' => $currentDate->format('Y-m-d'),
                    'time' => $time,
                    'duration' => $duration,
                ]);

                // Move to the same day in the next week
                $currentDate->addWeek();
            }
        }

        return redirect()->route('counsellor.deleteTimeSlotsView')->with('success', 'New time slots added successfully.');
    }

    public function adminDeleteTimeSlotsView($counsellor_id)
    {
        $counsellor = Counsellor::find($counsellor_id);

        if (!$counsellor) {
            return redirect()->route('admin.counsellors')->with('error', 'Counsellor not found.');
        }

        return view('admin.pages.delete_time_slots', compact('counsellor'));
    }

    public function adminDeleteAllTimeSlots($counsellor_id)
    {
        $admin = auth()->guard('admin')->user();

        if (!$admin) {
            return redirect()->route('home.index')->with('error', 'Unauthorized access.');
        }

        // Find the counselor by ID and delete their time slots
        $counsellor = Counsellor::find($counsellor_id);
        if (!$counsellor) {
            return redirect()->route('admin.counsellors')->with('error', 'Counsellor not found.');
        }

        $counsellor->timeSlots()->delete();

        return redirect()->route('admin.counsellors')->with('success', 'All time slots deleted successfully.');
    }

    public function adminAddTimeSlots(Request $request, $counsellor_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'weeks' => 'required|integer|min:1|max:52',
            'time_slots.*.day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time_slots.*.time' => 'required|date_format:H:i',
            'time_slots.*.duration' => 'required|integer|min:15|max:120',
        ]);

        // Retrieve the counsellor by ID
        $counsellor = Counsellor::find($counsellor_id);

        if (!$counsellor) {
            return redirect()->route('admin.dashboard')->with('error', 'Counsellor not found.');
        }

        // Generate weekly recurring time slots
        $weeksToGenerate = $validatedData['weeks']; // Number of weeks
        $startDate = Carbon::now(); // Start from the current date
        $endDate = $startDate->copy()->addWeeks($weeksToGenerate);

        foreach ($validatedData['time_slots'] as $slot) {
            $dayOfWeek = $slot['day_of_week'];
            $time = $slot['time'];
            $duration = $slot['duration'];

            // Generate recurring dates for each day of the week
            $currentDate = $startDate->copy()->next(Carbon::parse($dayOfWeek)->dayOfWeek); // Get the next occurrence of the day

            while ($currentDate->lte($endDate)) {
                // Save each time slot
                $counsellor->timeSlots()->create([
                    'date' => $currentDate->format('Y-m-d'),
                    'time' => $time,
                    'duration' => $duration,
                ]);

                // Move to the same day in the next week
                $currentDate->addWeek();
            }
        }

        return redirect()->route('admin.counsellor.changeTimeSlots', $counsellor_id)
            ->with('success', 'New time slots added successfully.');
    }

}
