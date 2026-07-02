<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ResultCard;
use App\Models\Student;
use App\Models\StudentMark;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ResultCalculationService
{
    public function __construct(
        protected GradingService $grading
    ) {}

    public function syncMark(StudentMark $mark): StudentMark
    {
        $schedule = $mark->examSchedule;
        $max = (float) $schedule->Max_Marks;
        $obtained = (float) $mark->Obtained_Marks;
        $percentage = $this->grading->markPercentage($obtained, $max);

        $mark->update([
            'Percentage' => $percentage,
            'Grade' => $this->grading->letterGrade($percentage),
        ]);

        return $mark->fresh();
    }

    public function generateForExam(Exam $exam): int
    {
        $exam->load('examSchedules.schoolClass', 'academicYear');
        $classIds = $exam->examSchedules->pluck('Class_ID')->unique();

        $students = Student::query()
            ->whereHas('section', fn ($q) => $q->whereIn('Class_ID', $classIds))
            ->with('section')
            ->get();

        $count = 0;

        foreach ($students as $student) {
            $this->upsertResultCard($exam, $student);
            $count++;
        }

        $this->assignClassRanks($exam, $classIds);

        return $count;
    }

    public function upsertResultCard(Exam $exam, Student $student): ResultCard
    {
        $classId = $student->section?->Class_ID;

        $schedules = ExamSchedule::query()
            ->where('Exam_ID', $exam->Exam_ID)
            ->when($classId, fn ($q) => $q->where('Class_ID', $classId))
            ->get();

        $scheduleIds = $schedules->pluck('Schedule_ID');
        $maxTotal = $schedules->sum('Max_Marks');

        $marks = StudentMark::query()
            ->where('Student_ID', $student->Student_ID)
            ->whereIn('Schedule_ID', $scheduleIds)
            ->get();

        $obtainedTotal = $marks->sum('Obtained_Marks');
        $percentage = $this->grading->markPercentage((float) $obtainedTotal, (float) $maxTotal);

        return ResultCard::updateOrCreate(
            [
                'Student_ID' => $student->Student_ID,
                'Exam_ID' => $exam->Exam_ID,
            ],
            [
                'Academic_Year_ID' => $exam->Academic_Year_ID,
                'Total_Marks' => $obtainedTotal,
                'Percentage' => $percentage,
                'Overall_Grade' => $this->grading->letterGrade($percentage),
                'Pass_Status' => $this->grading->isPassing($percentage),
            ]
        );
    }

    public function assignClassRanks(Exam $exam, Collection $classIds): void
    {
        foreach ($classIds as $classId) {
            $cards = ResultCard::query()
                ->where('Exam_ID', $exam->Exam_ID)
                ->whereHas('student.section', fn ($q) => $q->where('Class_ID', $classId))
                ->orderByDesc('Percentage')
                ->orderByDesc('Total_Marks')
                ->get();

            $rank = 1;
            foreach ($cards as $card) {
                $card->update(['Class_Rank' => $rank++]);
            }
        }
    }

    public function recalculateStudentExam(int $studentId, int $examId): void
    {
        $exam = Exam::findOrFail($examId);
        $student = Student::with('section')->findOrFail($studentId);

        DB::transaction(function () use ($exam, $student) {
            $this->upsertResultCard($exam, $student);
            $classId = $student->section?->Class_ID;
            if ($classId) {
                $this->assignClassRanks($exam, collect([$classId]));
            }
        });
    }
}
