<?php

namespace Database\Seeders;

use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamDemoSeeder extends Seeder
{
    public function run(): void
    {
        $yearId = 1;

        $midterm = Exam::firstOrCreate(
            ['Exam_Name' => 'Midterm Examination 2025-26'],
            [
                'Academic_Year_ID' => $yearId,
                'Start_Date' => '2025-11-01',
                'End_Date' => '2025-11-20',
            ]
        );

        $annual = Exam::firstOrCreate(
            ['Exam_Name' => 'Annual Examination 2025-26'],
            [
                'Academic_Year_ID' => $yearId,
                'Start_Date' => '2026-02-15',
                'End_Date' => '2026-03-15',
            ]
        );

        $midtermType = ExamType::where('Type_Name', 'Midterm')->first();
        $finalType = ExamType::where('Type_Name', 'Final')->first();

        if (! $midtermType || ! $finalType) {
            return;
        }

        $mappings = ClassSubject::all();

        $examSets = [
            ['exam' => $midterm, 'type' => $midtermType, 'dayBase' => 0],
            ['exam' => $annual, 'type' => $finalType, 'dayBase' => 14],
        ];

        foreach ($examSets as $set) {
            foreach ($mappings as $index => $mapping) {
                ExamSchedule::firstOrCreate(
                    [
                        'Exam_ID' => $set['exam']->Exam_ID,
                        'Class_ID' => $mapping->Class_ID,
                        'Subject_ID' => $mapping->Subject_ID,
                    ],
                    [
                        'Exam_Type_ID' => $set['type']->Exam_Type_ID,
                        'Exam_Date' => $set['exam']->Start_Date->copy()->addDays($set['dayBase'] + ($index % 10)),
                        'Max_Marks' => 100,
                        'Duration_Minutes' => 180,
                    ]
                );
            }
        }
    }
}
