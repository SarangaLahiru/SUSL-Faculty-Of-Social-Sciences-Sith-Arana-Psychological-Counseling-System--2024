<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Counsellor extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $primaryKey = 'counsellor_id';

    public function timeSlots()
    {
        return $this->hasMany(TimeSlots::class, 'counsellor_id', 'counsellor_id');
    }

    public function bookings() {
        return $this->hasMany(BookingDetails::class, 'counsellor_id', 'counsellor_id');
    }
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
}