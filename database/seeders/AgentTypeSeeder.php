<?php

namespace Database\Seeders;

use App\Models\AgentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agent_types = [
            [
                'name' => 'golden',
                'cost' => 1000000,
            ],
            [
                'name' => 'silver',
                'cost' => 1000000,
            ],
            [
                'name' => 'bronze',
                'cost' => 1000000,
            ]
        ];
        AgentType::truncate();
        foreach ($agent_types as $agent_type) {
            AgentType::create($agent_type);
        }
    }
}
