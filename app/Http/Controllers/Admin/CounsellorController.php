<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counsellor;
use App\Models\TimeSlots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        'counsellor_id' => 'required|integer|unique:counsellors', // Ensure it's an integer and unique
        'full_name_with_rate' => 'required|string|max:255',
        'title' => 'required|string|max:100',
        'gender' => 'required|in:male,female',
        'mobile_no' => 'required|string|max:15',
        'email' => 'required|string|email|max:255|unique:counsellors',
        'username' => 'required|string|max:255|unique:counsellors',
        'password' => 'required|string|min:8',
        'intro' => 'required|string',
        'bio' => 'required|string',
        'time_slots' => 'required|array', // Validate as an array
        'time_slots.*.date' => 'required|date', // Validate each date in the time_slots array
        'time_slots.*.time' => 'required|date_format:H:i', // Validate time with the correct format
    ]);

    // Create the counsellor
    $counsellor = Counsellor::create([
        'counsellor_id' => $validatedData['counsellor_id'],
        'full_name_with_rate' => $validatedData['full_name_with_rate'],
        'title' => $validatedData['title'],
        'gender' => $validatedData['gender'],
        'mobile_no' => $validatedData['mobile_no'],
        'email' => $validatedData['email'],
        'username' => $validatedData['username'],
        'password' => bcrypt($validatedData['password']), // Hash the password
        'intro' => $validatedData['intro'],
        'bio' => $validatedData['bio'],
    ]);

    // Loop through time slots and create them
    foreach ($validatedData['time_slots'] as $slot) {
        TimeSlots::create([
            'counsellor_id' => $validatedData['counsellor_id'], // Use the newly created counsellor's ID
            'date' => $slot['date'],
            'time' => $slot['time'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('admin.counsellors')->with('success', 'Counsellor added successfully with time slots.');
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
     public function update(Request $request, Counsellor $counsellor)
     {
         // Validate the request data
         $request->validate([
             'full_name_with_rate' => 'required|string|max:255',
             'title' => 'required|string|max:255',
             'gender' => 'required|in:female,male',
             'mobile_no' => 'required|string|max:15',
             'email' => 'required|email|unique:counsellors,email,' . $counsellor->counsellor_id, // Use counsellor_id
             'username' => 'required|string|unique:counsellors,username,' . $counsellor->counsellor_id, // Use counsellor_id
             'password' => 'nullable|string|min:6', // You might want to add logic for updating the password
             'intro' => 'required|string',
             'bio' => 'required|string',
         ]);

         // Update the counsellor's information
         $counsellor->full_name_with_rate = $request->full_name_with_rate;
         $counsellor->title = $request->title;
         $counsellor->gender = $request->gender;
         $counsellor->mobile_no = $request->mobile_no;
         $counsellor->email = $request->email;
         $counsellor->username = $request->username;
         $counsellor->intro = $request->intro;
         $counsellor->bio = $request->bio;

         // If the password is provided, hash it and update
         if ($request->filled('password')) {
             $counsellor->password = bcrypt($request->password);
         }

         // Save the updated counsellor
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
}