<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignStudentSectionRequest;
use App\Models\Section;
use App\Models\Student;

class AssignmentController extends Controller
{
    public function students()
    {
        $students = Student::with(['section.schoolClass'])
            ->orderBy('Roll_No')
            ->paginate(20);

        $sections = Section::with('schoolClass')->orderBy('Class_ID')->get();

        return view('admin.assignments.students', compact('students', 'sections'));
    }

    public function updateStudentSection(AssignStudentSectionRequest $request, Student $student)
    {
        $student->update(['Section_ID' => $request->Section_ID]);

        return back()->with('success', "Section updated for {$student->Full_Name}.");
    }
}
