<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

    class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golden_courses = [
            'ICDL',
        ];
        $silver_courses = [
            'TOT',
        ];
        $bronze_courses = [
            'Apps Developer',
        ];
        Course::truncate();
        foreach ($golden_courses as $course)
            Course::create([
                'name'=>$course,
                'description'=>$course,
                'agent_type_id'=>1,
            ]);
        foreach ($silver_courses as $course)
            Course::create([
                'name'=>$course,
                'description'=>$course,
                'agent_type_id'=>2,
            ]);
        foreach ($bronze_courses as $course)
            Course::create([
                'name'=>$course,
                'description'=>$course,
                'agent_type_id'=>3,
            ]);
    }
}
