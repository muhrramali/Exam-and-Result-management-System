<?php

namespace Database\Seeders;

use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $primary = ['English', 'Mathematics', 'Urdu', 'Islamic Studies'];
        $secondary = ['Physics', 'Chemistry', 'Biology', 'Pakistan Studies'];

        foreach (SchoolClass::all() as $schoolClass) {
            $level = (int) preg_replace('/\D/', '', $schoolClass->Class_Name);

            $subjectNames = $level >= 9
                ? array_merge($primary, $secondary)
                : ($level >= 6
                    ? array_merge($primary, ['Pakistan Studies'])
                    : $primary);

            foreach (Subject::whereIn('Subject_Name', $subjectNames)->get() as $subject) {
                ClassSubject::updateOrCreate(
                    [
                        'Class_ID' => $schoolClass->Class_ID,
                        'Subject_ID' => $subject->Subject_ID,
                    ],
                    ['Teacher_ID' => null]
                );
            }
        }
    }
}
