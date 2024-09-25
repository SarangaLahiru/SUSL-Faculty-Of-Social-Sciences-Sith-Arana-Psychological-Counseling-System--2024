<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable; // Correct class to extend
use Illuminate\Notifications\Notifiable; // Include this for notifications
use Illuminate\Auth\Passwords\CanResetPassword; // Include password reset functionality
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPassword; // Use the necessary traits

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add other fields as needed
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
