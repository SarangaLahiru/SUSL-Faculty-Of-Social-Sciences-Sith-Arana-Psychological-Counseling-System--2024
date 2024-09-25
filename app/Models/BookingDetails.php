<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id'; // Ensure correct primary key is set

    public function counsellor() {
        return $this->belongsTo(Counsellor::class, 'counsellor_id', 'counsellor_id');
    }

    public function timeSlot() { // Should be singular for belongsTo relation
        return $this->belongsTo(TimeSlots::class, 'timeslot_id', 'timeslot_id');
    }
}