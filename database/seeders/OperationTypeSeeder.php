<?php

namespace Database\Seeders;

use App\Models\OperationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Psy\Util\Str;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operations = [
            'إضافة دورة تدريبية',
            'حذف',
            'تعديل',
        ];
        OperationType::truncate();
        foreach ($operations as $operation){
            OperationType::create([
                'name' => $operation,
            ]);
        }
    }
}

