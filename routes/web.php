<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CounsellorsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class,'index']) -> name('home.index');

Route::get('/aboutus', [HomeController::class,'aboutus']) -> name('home.aboutus');

Route::get('/contactus', [HomeController::class,'contactus']) -> name('home.contactus');

// Resource controller for counsellors.

Route::resource('counsellors', CounsellorsController::class);

Route::resource('counsellors.bookings', BookingsController::class);

Route::get('/counsellors/{counsellor}/timeslots', [CounsellorsController::class, 'getAvailableTimeslots'])->name('counsellors.timeslots');