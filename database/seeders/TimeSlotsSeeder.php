<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeSlotsSeeder extends Seeder
{
    public function run()
    {
        // Dummy data
        $data = [
            [
                'timeslot_id' => 1,
                'counsellor_id' => 1,
                'date' => '2024-01-15',
                'time' => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'timeslot_id' => 2,
                'counsellor_id' => 1,
                'date' => '2024-01-15',
                'time' => '10:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'timeslot_id' => 3,
                'counsellor_id' => 1,
                'date' => '2024-01-16',
                'time' => '11:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'timeslot_id' => 4,
                'counsellor_id' => 1,
                'date' => '2024-01-16',
                'time' => '14:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'timeslot_id' => 5,
                'counsellor_id' => 1,
                'date' => '2024-01-17',
                'time' => '15:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('time_slots')->insert($data);
    }
}