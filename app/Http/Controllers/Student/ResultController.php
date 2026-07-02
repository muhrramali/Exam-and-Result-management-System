<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ResultCard;
use App\Models\Student;
use App\Models\StudentMark;

class ResultController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $resultCards = ResultCard::with(['exam.academicYear'])
            ->where('Student_ID', $student->Student_ID)
            ->where('Is_Published', true)
            ->latest()
            ->get();

        return view('student.results.index', compact('student', 'resultCards'));
    }

    public function show(ResultCard $resultCard)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        abort_unless(
            $resultCard->Student_ID === $student->Student_ID && $resultCard->Is_Published,
            403
        );

        $resultCard->load(['exam.academicYear', 'student.section.schoolClass']);

        $marks = StudentMark::with(['examSchedule.subject'])
            ->where('Student_ID', $student->Student_ID)
            ->whereHas('examSchedule', fn ($q) => $q->where('Exam_ID', $resultCard->Exam_ID))
            ->get();

        return view('reports.result-card', [
            'resultCard' => $resultCard,
            'marks' => $marks,
            'printMode' => false,
        ]);
    }
}
