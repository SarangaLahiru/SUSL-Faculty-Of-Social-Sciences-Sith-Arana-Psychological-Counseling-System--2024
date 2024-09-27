<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;
    protected $primaryKey = 'timeslot_id'; // Make sure this is correctly defined

    protected $fillable = [
        'counsellor_id',
        'date',
        'time',

    ];

    public function counsellor()
    {
        return $this->belongsTo(Counsellor::class, 'counsellor_id', 'counsellor_id');
    }

    public function bookings()
    {
        return $this->hasMany(BookingDetails::class, 'timeslot_id', 'timeslot_id');
    }

}
