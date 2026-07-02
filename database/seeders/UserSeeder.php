<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $section = Section::query()
            ->where('Section_Name', 'A')
            ->whereHas('schoolClass', fn ($q) => $q->where('Class_Name', 'Class 9'))
            ->first();

        $studentUser = User::create([
            'name' => 'Ali Hassan',
            'email' => 'student@school.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $studentUser->id,
            'Roll_No' => 'S1001',
            'Full_Name' => 'Ali Hassan',
            'Date_Of_Birth' => '2008-05-15',
            'Gender' => 'Male',
            'Contact' => '0311-9876543',
            'Section_ID' => $section?->Section_ID ?? 1,
        ]);
    }
}
