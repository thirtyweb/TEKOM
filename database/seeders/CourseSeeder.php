<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'code' => 'EKO1101',
                'name' => 'Ekonomi',
                'sks' => '2(2-0)',
                'prerequisite' => null,
                'semester' => 1,
                'category' => 'PPKU/Common Core Courses',
            ],
            [
                'code' => 'IPB110A',
                'name' => 'Agama Islam',
                'sks' => '3(2-1)',
                'prerequisite' => null,
                'semester' => 1,
                'category' => 'PPKU/Common Core Courses',
            ],
            [
                'code' => 'IPB110C',
                'name' => 'Pertanian Inovatif',
                'sks' => '2(2-0)',
                'prerequisite' => null,
                'semester' => 1,
                'category' => 'PPKU/Common Core Courses',
            ],
            [
                'code' => 'IPB110F',
                'name' => 'Bahasa Inggris',
                'sks' => '2(1-1)',
                'prerequisite' => null,
                'semester' => 1,
                'category' => 'PPKU/Common Core Courses',
            ],
            [
                'code' => 'KIM1104',
                'name' => 'Kimia Sains dan Teknologi',
                'sks' => '3(2-1)',
                'prerequisite' => null,
                'semester' => 1,
                'category' => 'PPKU/Common Core Courses',
            ],
            [
                'code' => 'KPM1131',
                'name' => 'Sosiologi',
                'sks' => '2(2-0)',
                'prerequisite' => null,
                'semester' => 2,
                'category' => 'PPKU/Common Core Courses',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}