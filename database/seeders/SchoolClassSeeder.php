<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        $academicYear = AcademicYear::first();

        for ($level = 1; $level <= 12; $level++) {
            $sectionNames = match (true) {
                $level <= 8 => ['A', 'B', 'C'],
                $level <= 10 => ['A', 'B', 'C'],
                default => ['A', 'B'],
            };

            $capacity = match (true) {
                $level <= 5 => 35,
                $level <= 8 => 40,
                $level <= 10 => 45,
                default => 35,
            };

            $schoolClass = SchoolClass::create([
                'Class_Name' => "Class {$level}",
                'Capacity' => $capacity,
                'Academic_Year_ID' => $academicYear->Year_ID,
            ]);

            foreach ($sectionNames as $sectionName) {
                Section::create([
                    'Section_Name' => $sectionName,
                    'Class_ID' => $schoolClass->Class_ID,
                ]);
            }
        }
    }
}
