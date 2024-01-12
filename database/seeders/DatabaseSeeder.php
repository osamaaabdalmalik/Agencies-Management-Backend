<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AgentTypeSeeder::class,
            CitySeeder::class,
            GovernorateSeeder::class,
            NationalitySeeder::class,
            CulturalLevelSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
