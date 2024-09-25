<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CounsellorAuthController;
use App\Http\Controllers\CounsellorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('home.aboutus');
Route::get('/contactus', [HomeController::class, 'contactus'])->name('home.contactus');

// Resource controller for counsellors.
Route::resource('counsellors', CounsellorsController::class);
Route::resource('counsellors.bookings', BookingsController::class);
Route::get('/counsellors/{counsellor}/timeslots', [CounsellorsController::class, 'getAvailableTimeslots'])->name('counsellors.timeslots');

// Counsellor Authentication Routes
Route::prefix('counsellor')->group(function () {
    Route::get('/login', [CounsellorAuthController::class, 'loginForm'])->name('counsellor.loginForm');
    Route::post('/login', [CounsellorAuthController::class, 'login'])->name('counsellor.login');
    Route::post('/logout', [CounsellorAuthController::class, 'logout'])->name('counsellor.logout');

    // Counsellor Dashboard Routes
    Route::middleware('auth:counsellor')->group(function () {
        Route::get('/dashboard', [CounsellorAuthController::class, 'dashboard'])->name('counsellor.dashboard');

        Route::get('/profile', function () {
            return view('counsellors.dashboard.pages.profile'); // Profile view
        })->name('counsellor.profile');

        Route::get('/availability', function () {
            return view('counsellors.dashboard.pages.availability'); // Availability view
        })->name('counsellor.availability');
    });
});