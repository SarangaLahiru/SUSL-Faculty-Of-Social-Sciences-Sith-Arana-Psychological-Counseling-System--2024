<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CounsellorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('counsellors')->insert([


            [
                'counsellor_id' => 1,
                'full_name_with_rate' => 'Dr. John Doe - $50/hr',
                'title' => 'Clinical Psychologist',
                'gender' => 'male',
                'mobile_no' => '0771234567',
                'email' => 'john.doe@example.com',
                'username' => 'johndoe',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Experienced psychologist with over 10 years in practice.',
                'bio' => 'Dr. John Doe specializes in cognitive-behavioral therapy and has extensive experience in dealing with anxiety and depression.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 2,
                'full_name_with_rate' => 'Ms. Jane Smith - $60/hr',
                'title' => 'Marriage Counselor',
                'gender' => 'female',
                'mobile_no' => '0777654321',
                'email' => 'jane.smith@example.com',
                'username' => 'janesmith',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Passionate marriage counselor dedicated to helping couples.',
                'bio' => 'Ms. Jane Smith focuses on relationship issues and provides a safe space for couples to communicate effectively.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 3,
                'full_name_with_rate' => 'Dr. Emily White - $55/hr',
                'title' => 'Child Psychologist',
                'gender' => 'female',
                'mobile_no' => '0771234568',
                'email' => 'emily.white@example.com',
                'username' => 'emilywhite',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Specializing in developmental psychology for children.',
                'bio' => 'Dr. Emily White has over 8 years of experience working with children and adolescents.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 4,
                'full_name_with_rate' => 'Mr. Michael Brown - $65/hr',
                'title' => 'Addiction Specialist',
                'gender' => 'male',
                'mobile_no' => '0771234569',
                'email' => 'michael.brown@example.com',
                'username' => 'michaelbrown',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Helping individuals overcome addiction challenges.',
                'bio' => 'Mr. Michael Brown has a strong background in substance abuse counseling.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 5,
                'full_name_with_rate' => 'Dr. Sarah Johnson - $70/hr',
                'title' => 'Trauma Therapist',
                'gender' => 'female',
                'mobile_no' => '0771234570',
                'email' => 'sarah.johnson@example.com',
                'username' => 'sarahjohnson',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Specializing in trauma recovery and resilience.',
                'bio' => 'Dr. Sarah Johnson uses evidence-based techniques to help clients heal from trauma.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 6,
                'full_name_with_rate' => 'Mr. David Lee - $50/hr',
                'title' => 'Behavioral Therapist',
                'gender' => 'male',
                'mobile_no' => '0771234571',
                'email' => 'david.lee@example.com',
                'username' => 'davidlee',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Focusing on behavior modification techniques.',
                'bio' => 'Mr. David Lee helps clients implement strategies for behavior change.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 7,
                'full_name_with_rate' => 'Dr. Lisa Miller - $65/hr',
                'title' => 'Family Therapist',
                'gender' => 'female',
                'mobile_no' => '0771234572',
                'email' => 'lisa.miller@example.com',
                'username' => 'lisamiller',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Dedicated to improving family dynamics.',
                'bio' => 'Dr. Lisa Miller offers family counseling to help improve communication and resolve conflicts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 8,
                'full_name_with_rate' => 'Mr. Alex Wilson - $55/hr',
                'title' => 'Life Coach',
                'gender' => 'male',
                'mobile_no' => '0771234573',
                'email' => 'alex.wilson@example.com',
                'username' => 'alexwilson',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Helping clients achieve personal and professional goals.',
                'bio' => 'Mr. Alex Wilson specializes in goal-setting and personal development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 9,
                'full_name_with_rate' => 'Dr. Rachel Green - $75/hr',
                'title' => 'Clinical Social Worker',
                'gender' => 'female',
                'mobile_no' => '0771234574',
                'email' => 'rachel.green@example.com',
                'username' => 'rachelgreen',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Integrating social services and mental health.',
                'bio' => 'Dr. Rachel Green provides holistic support for mental health and social issues.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'counsellor_id' => 10,
                'full_name_with_rate' => 'Mr. Chris Evans - $80/hr',
                'title' => 'Psychiatrist',
                'gender' => 'male',
                'mobile_no' => '0771234575',
                'email' => 'chris.evans@example.com',
                'username' => 'chrisevans',
                'password' => Hash::make('password123'), // Hash the password
                'intro' => 'Specializing in psychiatric evaluation and treatment.',
                'bio' => 'Mr. Chris Evans is a licensed psychiatrist with a focus on mental health disorders.',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // Add more entries as needed
        ]);
    }
}