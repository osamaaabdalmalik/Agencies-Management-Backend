<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            'سوري',
            'فلسطيني',
            'سعودي',
        ];
        Nationality::truncate();
        foreach ($nationalities as $nationality){
            Nationality::create([
                'name' => $nationality,
            ]);
        }
    }
}
