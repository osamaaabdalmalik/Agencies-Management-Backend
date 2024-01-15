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
            AdminSeeder::class,
            OperationTypeSeeder::class,
            AgentTypeSeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            NationalitySeeder::class,
            CulturalLevelSeeder::class,
            AgentsSeeder::class,
        ]);
    }
}
