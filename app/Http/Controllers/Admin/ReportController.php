<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ResultCard;
use App\Models\SchoolClass;
use App\Models\StudentMark;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function resultCard(ResultCard $resultCard)
    {
        $resultCard->load([
            'student.section.schoolClass',
            'exam.academicYear',
            'exam',
        ]);

        $marks = StudentMark::with(['examSchedule.subject'])
            ->where('Student_ID', $resultCard->Student_ID)
            ->whereHas('examSchedule', fn ($q) => $q->where('Exam_ID', $resultCard->Exam_ID))
            ->get();

        return view('reports.result-card', compact('resultCard', 'marks'));
    }

    public function classSummary(Request $request)
    {
        $exams = Exam::orderByDesc('Start_Date')->get();
        $classes = SchoolClass::orderBy('Class_Name')->get();

        $examId = $request->integer('exam_id') ?: $exams->first()?->Exam_ID;
        $classId = $request->integer('class_id') ?: $classes->first()?->Class_ID;

        $summary = null;

        if ($examId && $classId) {
            $cards = ResultCard::with('student')
                ->where('Exam_ID', $examId)
                ->whereHas('student.section', fn ($q) => $q->where('Class_ID', $classId))
                ->get();

            $subjectStats = StudentMark::query()
                ->whereHas('examSchedule', fn ($q) => $q
                    ->where('Exam_ID', $examId)
                    ->where('Class_ID', $classId))
                ->with('examSchedule.subject')
                ->get()
                ->groupBy(fn ($m) => $m->examSchedule->subject->Subject_Name)
                ->map(fn ($group) => [
                    'count' => $group->count(),
                    'average' => round($group->avg('Percentage'), 2),
                    'highest' => round($group->max('Percentage'), 2),
                    'lowest' => round($group->min('Percentage'), 2),
                ]);

            $summary = [
                'total_students' => $cards->count(),
                'passed' => $cards->where('Pass_Status', true)->count(),
                'failed' => $cards->where('Pass_Status', false)->count(),
                'average_percentage' => $cards->count() ? round($cards->avg('Percentage'), 2) : 0,
                'top_students' => $cards->sortBy('Class_Rank')->take(5),
                'subject_stats' => $subjectStats,
            ];
        }

        return view('admin.reports.class-summary', compact(
            'exams', 'classes', 'examId', 'classId', 'summary'
        ));
    }
}
