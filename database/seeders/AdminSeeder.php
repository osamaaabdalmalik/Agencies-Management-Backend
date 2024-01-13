<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'user_name'=>'Qassem',
                'full_name'=>'Qassem Alshemly',
                'email'=>'qassem@gmail.com',
                'phone'=>'0924365987',
                'password'=>bcrypt('123456789'),
            ],
        ];
        Admin::truncate();
        foreach ($admins as $admin){
            Admin::create($admin);
        }
    }
}
