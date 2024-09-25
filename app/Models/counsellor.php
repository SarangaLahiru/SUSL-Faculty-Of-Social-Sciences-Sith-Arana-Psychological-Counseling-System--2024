<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Change this
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword; // Add this
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait; // Add this trait

class Counsellor extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, CanResetPasswordTrait; // Use the necessary traits

    // Set the primary key
    protected $primaryKey = 'counsellor_id';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'full_name_with_rate',
        'title',
        'gender',
        'mobile_no',
        'email',
        'username',
        'password',
        'intro',
        'bio',
    ];

    // Hidden attributes for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship with TimeSlots model
    public function timeSlots()
    {
        return $this->hasMany(TimeSlots::class, 'counsellor_id', 'counsellor_id');
    }

    // Relationship with BookingDetails model
    public function bookings() {
        return $this->hasMany(BookingDetails::class, 'counsellor_id', 'counsellor_id');
    }
}