<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Receptionist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $receptionists = [
            [
                'user_name'=>'Qassem',
                'full_name'=>'Qassem Alshemly',
                'phone'=>'0924365987',
                'password'=>Hash::make('123456789'),
            ],
        ];
        Receptionist::truncate();
        foreach ($receptionists as $receptionist){
            Receptionist::create($receptionist);
        }
    }
}
