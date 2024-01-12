<?php

namespace Database\Seeders;

use App\Models\CulturalLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CulturalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cultural_levels = [
            'A',
            'B',
            'C',
        ];
        foreach ($cultural_levels as $cultural_level){
            CulturalLevel::create([
                'name' => $cultural_level,
            ]);
        }
    }
}
