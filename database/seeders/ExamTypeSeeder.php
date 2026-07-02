<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Midterm', 'Final', 'Quiz', 'Practical'] as $type) {
            ExamType::firstOrCreate(['Type_Name' => $type]);
        }
    }
}
