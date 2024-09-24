<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;
    public function counsellor()
    {
        return $this->belongsTo(Counsellor::class, 'counsellor_id', 'counsellor_id');
    }
}