<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'user_name'=>'قاسم',
                'full_name'=>'Qassem Alshemly',
                'email'=>'osamaaabdalmalik@gmail.com',
                'phone'=>'0924365987',
                'password'=>Hash::make('123456789'),
            ],
            [
                'user_name'=>'Qassem',
                'full_name'=>'Qassem Alshemly',
                'email'=>'esraaalghabra3040@gmail.com',
                'phone'=>'09243659878',
                'password'=>Hash::make('123456789'),
            ],
            [
                'user_name'=>'أسامة عبد الملك',
                'full_name'=>'Qassem Alshemly',
                'email'=>'microtech.softteam@gmail.com',
                'phone'=>'09243659838',
                'password'=>Hash::make('123456789'),
            ],
        ];
        Admin::truncate();
        foreach ($admins as $admin){
            Admin::create($admin);
        }
    }
}
