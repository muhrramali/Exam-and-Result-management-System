<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ResultCard;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\User;
use App\Services\ResultCalculationService;
use Illuminate\Database\Seeder;

class DemoResultsSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::whereHas('user', fn ($q) => $q->where('email', 'student@school.com'))->first();

        if (! $student?->section) {
            return;
        }

        $classId = $student->section->Class_ID;
        $calculator = app(ResultCalculationService::class);

        $sampleMarks = [72, 85, 68, 91, 76, 88, 55, 79];

        foreach (Exam::all() as $exam) {
            $schedules = ExamSchedule::where('Exam_ID', $exam->Exam_ID)
                ->where('Class_ID', $classId)
                ->get();

            foreach ($schedules as $i => $schedule) {
                $obtained = $sampleMarks[$i % count($sampleMarks)] + (($exam->Exam_ID + $i) % 5);

                $mark = StudentMark::updateOrCreate(
                    [
                        'Student_ID' => $student->Student_ID,
                        'Schedule_ID' => $schedule->Schedule_ID,
                    ],
                    ['Obtained_Marks' => min($obtained, $schedule->Max_Marks)]
                );

                $calculator->syncMark($mark);
            }

            $calculator->generateForExam($exam);
        }

        ResultCard::query()->update(['Is_Published' => true]);
    }
}
