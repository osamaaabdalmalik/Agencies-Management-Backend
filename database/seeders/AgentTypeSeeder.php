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
            'golden',
            'silver',
            'bronze',
        ];
        AgentType::truncate();
        foreach ($agent_types as $agent_type) {
            $i = 1000000;
            $j = 0;
            AgentType::create([
                'name' => $agent_type,
                'cost' => $i + $j,
            ]);
            $j+=100;
        }
    }
}
