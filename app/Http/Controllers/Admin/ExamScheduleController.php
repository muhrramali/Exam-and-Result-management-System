<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ExamType;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function index(Exam $exam)
    {
        $schedules = ExamSchedule::with(['schoolClass', 'subject', 'examType'])
            ->where('Exam_ID', $exam->Exam_ID)
            ->orderBy('Exam_Date')
            ->paginate(20);

        return view('admin.exam-schedules.index', compact('exam', 'schedules'));
    }

    public function create(Exam $exam)
    {
        return view('admin.exam-schedules.create', [
            'exam' => $exam,
            'classes' => SchoolClass::orderBy('Class_Name')->get(),
            'subjects' => Subject::orderBy('Subject_Name')->get(),
            'examTypes' => ExamType::orderBy('Type_Name')->get(),
            'classSubjects' => ClassSubject::with(['schoolClass', 'subject'])->get(),
        ]);
    }

    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'Class_ID' => ['required', 'exists:classes,Class_ID'],
            'Subject_ID' => ['required', 'exists:subjects,Subject_ID'],
            'Exam_Type_ID' => ['required', 'exists:exam_types,Exam_Type_ID'],
            'Exam_Date' => ['required', 'date'],
            'Max_Marks' => ['required', 'integer', 'min:1'],
            'Duration_Minutes' => ['required', 'integer', 'min:15'],
        ]);

        ExamSchedule::create(array_merge($validated, ['Exam_ID' => $exam->Exam_ID]));

        return redirect()->route('admin.exams.schedules.index', $exam)
            ->with('success', 'Exam schedule added successfully.');
    }

    public function destroy(Exam $exam, ExamSchedule $schedule)
    {
        abort_unless($schedule->Exam_ID === $exam->Exam_ID, 404);
        $schedule->delete();

        return back()->with('success', 'Schedule removed successfully.');
    }
}
