<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counsellor;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $counsellors = Counsellor::all();
        return view('admin.pages.counsellors', compact('counsellors'));
        // return view('admin.pages.counsellors'); // Create this view
    }
    public function bookings()
    {
        return view('admin.pages.bookings'); // Create this view
    }
    public function counsellors()
    {
        $counsellors = Counsellor::all();
        return view('admin.pages.counsellors', compact('counsellors'));
    }
}
