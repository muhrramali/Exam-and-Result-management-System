<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        AcademicYear::create([
            'Session' => '2025-2026',
            'Start_Date' => '2025-04-01',
            'End_Date' => '2026-03-31',
        ]);
    }
}