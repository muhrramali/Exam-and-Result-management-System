<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\RecheckRequest;
use App\Models\ResultCard;
use App\Models\Student;
use App\Models\StudentMark;
use Illuminate\Http\Request;

class RecheckRequestController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $requests = RecheckRequest::with(['studentMark.examSchedule.subject', 'studentMark.examSchedule.exam'])
            ->where('Student_ID', $student->Student_ID)
            ->latest('Request_Date')
            ->get();

        $publishedExamIds = ResultCard::where('Student_ID', $student->Student_ID)
            ->where('Is_Published', true)
            ->pluck('Exam_ID');

        $pendingMarkIds = RecheckRequest::where('Student_ID', $student->Student_ID)
            ->where('Status', 'Pending')
            ->pluck('Marks_ID');

        $marks = StudentMark::with(['examSchedule.subject', 'examSchedule.exam'])
            ->where('Student_ID', $student->Student_ID)
            ->whereHas('examSchedule', fn ($q) => $q->whereIn('Exam_ID', $publishedExamIds))
            ->whereNotIn('Marks_ID', $pendingMarkIds)
            ->orderByDesc('Marks_ID')
            ->get();

        return view('student.recheck.index', compact('requests', 'marks', 'publishedExamIds'));
    }

    public function store(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'Marks_ID' => ['required', 'exists:student_marks,Marks_ID'],
            'Reason' => ['required', 'string', 'max:1000'],
        ]);

        $mark = StudentMark::with('examSchedule')->findOrFail($validated['Marks_ID']);

        abort_unless($mark->Student_ID === $student->Student_ID, 403);

        $hasPublished = ResultCard::where('Student_ID', $student->Student_ID)
            ->where('Exam_ID', $mark->examSchedule->Exam_ID)
            ->where('Is_Published', true)
            ->exists();

        abort_unless($hasPublished, 403, 'Results for this exam are not published yet.');

        $exists = RecheckRequest::where('Marks_ID', $mark->Marks_ID)
            ->where('Status', 'Pending')
            ->exists();

        if ($exists) {
            return back()->withErrors(['Marks_ID' => 'A pending re-check request already exists for this subject.']);
        }

        RecheckRequest::create([
            'Student_ID' => $student->Student_ID,
            'Marks_ID' => $mark->Marks_ID,
            'Reason' => $validated['Reason'],
            'Status' => 'Pending',
            'Request_Date' => now(),
        ]);

        return back()->with('success', 'Re-check request submitted successfully.');
    }
}
