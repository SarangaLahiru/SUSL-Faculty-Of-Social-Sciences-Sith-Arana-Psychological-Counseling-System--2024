<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin.counsellors'); // Create this view
    }
    public function bookings()
    {
        return view('admin.pages.bookings'); // Create this view
    }
    public function counsellors()
    {
        return view('admin.pages.counsellors'); // Create this view
    }
}