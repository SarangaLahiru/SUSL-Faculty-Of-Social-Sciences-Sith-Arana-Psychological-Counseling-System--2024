<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSlotsSeeder extends Seeder
{
    public function run()
    {
        DB::table('time_slots')->insert([
            // Time slots for Counselor ID 1
           // Time slots for Counsellor 1
           ['counsellor_id' => 1, 'date' => '2024-01-01', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 1, 'date' => '2024-01-01', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 1, 'date' => '2024-01-01', 'time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 2
           ['counsellor_id' => 2, 'date' => '2024-01-02', 'time' => '09:30:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 2, 'date' => '2024-01-02', 'time' => '10:30:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 3
           ['counsellor_id' => 3, 'date' => '2024-01-03', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 3, 'date' => '2024-01-03', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 4
           ['counsellor_id' => 4, 'date' => '2024-01-04', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 4, 'date' => '2024-01-04', 'time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 5
           ['counsellor_id' => 5, 'date' => '2024-01-05', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 5, 'date' => '2024-01-05', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 6
           ['counsellor_id' => 6, 'date' => '2024-01-06', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 6, 'date' => '2024-01-06', 'time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 7
           ['counsellor_id' => 7, 'date' => '2024-01-07', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 7, 'date' => '2024-01-07', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 8
           ['counsellor_id' => 8, 'date' => '2024-01-08', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 8, 'date' => '2024-01-08', 'time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 9
           ['counsellor_id' => 9, 'date' => '2024-01-09', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 9, 'date' => '2024-01-09', 'time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],

           // Time slots for Counsellor 10
           ['counsellor_id' => 10, 'date' => '2024-01-10', 'time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],
           ['counsellor_id' => 10, 'date' => '2024-01-10', 'time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],








            // Add more entries as needed
        ]);
    }
}