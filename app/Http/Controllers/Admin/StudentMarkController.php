<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSchedule;
use App\Models\Student;
use App\Models\StudentMark;
use App\Services\AuditService;
use App\Services\ResultCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMarkController extends Controller
{
    public function __construct(
        protected ResultCalculationService $results,
        protected AuditService $audit
    ) {}

    public function index(ExamSchedule $schedule)
    {
        $schedule->load(['exam', 'schoolClass', 'subject', 'examType']);

        $students = Student::query()
            ->whereHas('section', fn ($q) => $q->where('Class_ID', $schedule->Class_ID))
            ->with(['studentMarks' => fn ($q) => $q->where('Schedule_ID', $schedule->Schedule_ID)])
            ->orderBy('Roll_No')
            ->get();

        return view('admin.marks.index', compact('schedule', 'students'));
    }

    public function store(Request $request, ExamSchedule $schedule)
    {
        $validated = $request->validate([
            'marks' => ['required', 'array'],
            'marks.*.Student_ID' => ['required', 'exists:students,Student_ID'],
            'marks.*.Obtained_Marks' => ['nullable', 'numeric', 'min:0', 'max:'.$schedule->Max_Marks],
        ]);

        DB::transaction(function () use ($validated, $schedule) {
            foreach ($validated['marks'] as $row) {
                if ($row['Obtained_Marks'] === null || $row['Obtained_Marks'] === '') {
                    continue;
                }

                $mark = StudentMark::updateOrCreate(
                    [
                        'Student_ID' => $row['Student_ID'],
                        'Schedule_ID' => $schedule->Schedule_ID,
                    ],
                    ['Obtained_Marks' => $row['Obtained_Marks']]
                );

                $this->results->syncMark($mark);
            }
        });

        return back()->with('success', 'Marks saved successfully.');
    }

    public function correct(Request $request, StudentMark $mark)
    {
        $validated = $request->validate([
            'Obtained_Marks' => ['required', 'numeric', 'min:0'],
            'Reason' => ['required', 'string', 'max:500'],
        ]);

        $schedule = $mark->examSchedule;
        if ($validated['Obtained_Marks'] > $schedule->Max_Marks) {
            return back()->withErrors(['Obtained_Marks' => "Marks cannot exceed {$schedule->Max_Marks}."]);
        }

        $old = $mark->only(['Obtained_Marks', 'Grade', 'Percentage']);

        DB::transaction(function () use ($mark, $validated, $old, $schedule) {
            $mark->update(['Obtained_Marks' => $validated['Obtained_Marks']]);
            $this->results->syncMark($mark);

            $this->audit->log(
                'student_marks',
                $mark->Marks_ID,
                $old,
                $mark->fresh()->only(['Obtained_Marks', 'Grade', 'Percentage']),
                $validated['Reason']
            );

            $this->results->recalculateStudentExam($mark->Student_ID, $schedule->Exam_ID);
        });

        return back()->with('success', 'Mark corrected and result recalculated.');
    }
}
