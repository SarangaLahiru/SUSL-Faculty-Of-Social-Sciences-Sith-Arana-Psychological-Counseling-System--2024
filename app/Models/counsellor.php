<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class counsellor extends Model
{
    protected $primaryKey = 'counsellor_id';
    use HasFactory;
    public function timeSlots()
    {
        return $this->hasMany(TimeSlots::class, 'counsellor_id', 'counsellor_id');
    }

}