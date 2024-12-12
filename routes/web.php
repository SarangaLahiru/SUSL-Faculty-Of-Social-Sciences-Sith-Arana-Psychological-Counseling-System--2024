<?php


use App\Http\Controllers\Counsellor\Auth\ForgotPasswordController;
use App\Http\Controllers\Counsellor\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\CounsellorController;
use App\Http\Controllers\Counsellor\Auth\CounsellorAuthController;
use App\Http\Controllers\student\BookingsController;
use App\Http\Controllers\student\CounsellorsController;
use App\Http\Controllers\student\HomeController;

use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BookingAnalysisController;

Route::get('/download-analysis-pdf', [BookingAnalysisController::class, 'generateAnalysisPDF']);
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::post('/send/message', function () {
    // Sending the SMS using Laravel's Http client
    $response = Http::post('https://api.dialog.lk/sms/send', [
        'message' => 'Hello',
        'destinationAddresses' => ['tel:0772879128'],
        'password' => '10f867692dc1747eb88c254c1b2edccf',
        'applicationId' => 'APP_066306',
    ]);

    return response()->json($response->json());
});
Route::get('/calendar', function () {
    return view('counsellors.calendar');
});
// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('home.aboutus');
Route::get('/contactus', [HomeController::class, 'contactus'])->name('home.contactus');
Route::get('/calendar', [HomeController::class, 'calendar'])->name('home.calendar');

// Resource controller for counsellors.
Route::resource('counsellors', CounsellorsController::class);
Route::resource('counsellors.bookings', BookingsController::class);
Route::get('/counsellors/{counsellor}/timeslots', [CounsellorsController::class, 'getAvailableTimeslots'])->name('counsellors.timeslots');
Route::patch('/admin/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
// Counsellor Authentication Routes
Route::prefix('counsellor')->group(function () {

    // Counsellor login and logout routes
    Route::get('/login', [CounsellorAuthController::class, 'loginForm'])->name('counsellor.loginForm');
    Route::post('/login', [CounsellorAuthController::class, 'login'])->name('counsellor.login');
    Route::post('/logout', [CounsellorAuthController::class, 'logout'])->name('counsellor.logout');

    // Routes that require counsellor authentication
    Route::middleware('auth:counsellor')->group(function () {

        // Counsellor dashboard and profile management
        Route::get('/dashboard', [CounsellorAuthController::class, 'dashboard'])->name('counsellor.dashboard');
        Route::get('/profile', [CounsellorAuthController::class, 'profile'])->name('counsellor.profile');
        Route::put('/profile/{id}', [CounsellorAuthController::class, 'update'])->name('profile.update');

        // Counsellor availability and details editing
        Route::get('/availability', [CounsellorAuthController::class, 'availability'])->name('counsellor.availability');
        Route::get('/editDetails', [CounsellorAuthController::class, 'editDetails'])->name('counsellor.editDetails');

        // Booking management (e.g., deleting a booking)
        Route::delete('/bookings/{booking}', [BookingsController::class, 'destroy'])->name('bookings.destroy');
        Route::delete('/counsellors/availability/delete/{id}', [CounsellorsController::class, 'deleteTimeSlot'])->name('counsellors.availability.delete');





        Route::post('counsellor/availability/store', [CounsellorAuthController::class, 'store'])->name('counsellors.availability.store');

    });
    Route::post('/bookings/{id}/status', [CounsellorAuthController::class, 'markAsDone'])->name('bookings.status');

    // Password reset routes (should be inside the counsellor prefix group)
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('counsellor.password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('counsellor.password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('counsellor.password.update');
});

// Admin Routes
Route::prefix('admin')->group(function () {

    // Admin login routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    // Protected routes requiring admin authentication
    Route::middleware('auth:admin')->group(function () {

        // Admin dashboard and counsellor management
        // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/counsellors', [AdminDashboardController::class, 'counsellors'])->name('admin.counsellors');

        // Bookings management
        Route::get('/bookings', [AdminDashboardController::class, 'bookings'])->name('admin.bookings');
        Route::get('/feedback', [AdminDashboardController::class, 'feedback'])->name('admin.feedback');

        // Admin logout route
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // Password Reset Link Request Routes
        Route::get('/password/reset', [AdminResetPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
        Route::post('/password/email', [AdminResetPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
        Route::resource('counsellorsShow', CounsellorController::class);




        Route::delete('/admin/bookings/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.bookings.destroy');





    });
     // Password Reset Routes
     Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
     Route::post('/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
});


Route::get('/counsellor/session/delete/{timeslot}', [SessionController::class, 'deleteSession'])
    ->name('session.delete');
    Route::get('/counsellor/session/confirm/{timeslot}', [SessionController::class, 'confirmSession'])
    ->name('session.confirm');