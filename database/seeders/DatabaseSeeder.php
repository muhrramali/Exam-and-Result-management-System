<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GradingScaleSeeder::class,
            AcademicYearSeeder::class,
            SubjectSeeder::class,
            SchoolClassSeeder::class,
            ExamTypeSeeder::class,
            ClassSubjectSeeder::class,
            UserSeeder::class,
            ExamDemoSeeder::class,
            DemoResultsSeeder::class,
        ]);
    }
}
