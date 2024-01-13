<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $cities = [
        [
            'name'=>'سوريا',
            'governorate_id'=>1
        ],
        [
            'name'=>'مصر',
            'governorate_id'=>2
        ],
        [
            'name'=>'السعودية',
            'governorate_id'=>3
        ],
    ];
        City::truncate();
        foreach ($cities as $city)
        City::create($city);
    }
}
