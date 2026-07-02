<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('academicYear')
            ->withCount('examSchedules')
            ->latest('Start_Date')
            ->paginate(15);

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create', [
            'academicYears' => AcademicYear::orderByDesc('Start_Date')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Exam_Name' => ['required', 'string', 'max:50'],
            'Academic_Year_ID' => ['required', 'exists:academic_years,Year_ID'],
            'Start_Date' => ['required', 'date'],
            'End_Date' => ['required', 'date', 'after_or_equal:Start_Date'],
        ]);

        Exam::create($validated);

        return redirect()->route('admin.exams.index')
            ->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load(['academicYear', 'examSchedules.schoolClass', 'examSchedules.subject', 'examSchedules.examType']);

        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        return view('admin.exams.edit', [
            'exam' => $exam,
            'academicYears' => AcademicYear::orderByDesc('Start_Date')->get(),
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'Exam_Name' => ['required', 'string', 'max:50'],
            'Academic_Year_ID' => ['required', 'exists:academic_years,Year_ID'],
            'Start_Date' => ['required', 'date'],
            'End_Date' => ['required', 'date', 'after_or_equal:Start_Date'],
        ]);

        $exam->update($validated);

        return redirect()->route('admin.exams.index')
            ->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('admin.exams.index')
            ->with('success', 'Exam deleted successfully.');
    }
}
