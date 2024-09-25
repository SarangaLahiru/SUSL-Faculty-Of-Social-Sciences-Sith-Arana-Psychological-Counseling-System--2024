<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CounsellorAuthController;
use App\Http\Controllers\CounsellorsController;
use App\Http\Controllers\Counsellor\Auth\ForgotPasswordController;
use App\Http\Controllers\Counsellor\Auth\ResetPasswordController;
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

        Route::get('/profile',
        [CounsellorAuthController::class, 'profile'])
        ->name('counsellor.profile');

        Route::get('/availability',
            [CounsellorAuthController::class, 'availability'])
        ->name('counsellor.availability');

        Route::get('/editDetails',
            [CounsellorAuthController::class, 'editDetails'])
        ->name('counsellor.editDetails');

        Route::delete('/bookings/{booking}', [BookingsController::class, 'destroy'])->name('bookings.destroy');
      // Display the profile edit form

// Update the profile
    Route::put('/profile/{id}', [CounsellorAuthController::class, 'update'])->name('profile.update');
    });

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('counsellor.password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('counsellor.password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('counsellor.password.update');
});
