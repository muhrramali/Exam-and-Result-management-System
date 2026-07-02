<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::insert([
            ['Subject_Code' => 'ENG101', 'Subject_Name' => 'English', 'Credits' => 3],
            ['Subject_Code' => 'MATH101', 'Subject_Name' => 'Mathematics', 'Credits' => 4],
            ['Subject_Code' => 'PHY101', 'Subject_Name' => 'Physics', 'Credits' => 3],
            ['Subject_Code' => 'CHE101', 'Subject_Name' => 'Chemistry', 'Credits' => 3],
            ['Subject_Code' => 'BIO101', 'Subject_Name' => 'Biology', 'Credits' => 3],
            ['Subject_Code' => 'URD101', 'Subject_Name' => 'Urdu', 'Credits' => 2],
            ['Subject_Code' => 'ISL101', 'Subject_Name' => 'Islamic Studies', 'Credits' => 2],
            ['Subject_Code' => 'PAK101', 'Subject_Name' => 'Pakistan Studies', 'Credits' => 2],
        ]);
    }
}