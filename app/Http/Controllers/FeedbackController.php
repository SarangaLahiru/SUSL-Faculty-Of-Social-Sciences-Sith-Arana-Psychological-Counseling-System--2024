<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Store feedback from the contact form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'counsellor_id' => 0, // Default to 0 for general feedback
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }



    // Update feedback status (publish/unpublish)
    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->update(['is_published' => !$feedback->is_published]);

        return redirect()->back()->with('success', 'Feedback status updated successfully.');
    }
}