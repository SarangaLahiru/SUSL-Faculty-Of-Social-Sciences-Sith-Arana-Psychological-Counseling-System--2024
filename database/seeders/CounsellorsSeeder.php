<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CounsellorsSeeder extends Seeder
{
    public function run()
    {
        // Insert dummy data
        $data = [
            [
                'counsellor_id' => 1,
                'full_name_with_rate' => 'Dr. John Doe, $100/hr',
                'title' => 'Dr.',
                'gender' => 'male',
                'mobile_no' => '1234567890',
                'email' => 'john.doe@example.com',
                'intro' => 'Experienced counselor with a focus on mental health.',
                'bio' => 'John has over 10 years of experience in the field of counseling, specializing in mental health and wellness.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'counsellor_id' => 2,
                'full_name_with_rate' => 'Ms. Jane Smith, $80/hr',
                'title' => 'Ms.',
                'gender' => 'female',
                'mobile_no' => '0987654321',
                'email' => 'jane.smith@example.com',
                'intro' => 'Passionate about helping individuals achieve their goals.',
                'bio' => 'Jane has a background in psychology and has worked with various organizations to help individuals reach their full potential.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more dummy data as needed
        ];

        DB::table('counsellors')->insert($data);
    }
}