<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Client;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $client = Client::create([
            'full_name' => 'أحمد',
            'mother_name' => 'عائشة',
            'gender' => 'ذكر',
            'birth_date' => '2000-10-20',
            'phone' => '0955441177',
            'email' => 'osama@gmail.com',
            'nationality_id' => 1,
            'cultural_level_id' => 1,
            'governorate_id' => 1,
            'city_id' => 1,
        ]);
        $course1 = Course::create([
            'name' => 'ICDL',
            'description' => 'ICDL description',
            'agent_type_id' => 1,
        ]);
        Course::create([
            'name' => 'TOT',
            'description' => 'TOT description',
            'agent_type_id' => 2,
        ]);
        Course::create([
            'name' => 'Photoshop',
            'description' => 'Photoshop description',
            'agent_type_id' => 3,
        ]);

        Agent::create([
            'receipt_number' => '60000',
            'password' => Hash::make('123456789'),
            'course_id' => $course1->id,
            'client_id' => $client->id,
        ]);
    }
}
