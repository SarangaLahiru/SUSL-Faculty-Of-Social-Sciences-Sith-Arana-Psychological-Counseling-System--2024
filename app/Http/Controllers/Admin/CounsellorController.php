<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counsellor;
use App\Models\TimeSlots;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\CounsellorCredentials;
use Illuminate\Support\Facades\Mail;

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
             'post'=>'required|string',
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
         $counsellor->post = $request->post;
         $counsellor->intro = $request->intro;

         dd($request->post);

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