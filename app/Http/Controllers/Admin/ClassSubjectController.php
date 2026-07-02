<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $mappings = ClassSubject::with(['schoolClass', 'subject'])
            ->orderBy('Class_ID')
            ->paginate(20);

        return view('admin.class-subjects.index', compact('mappings'));
    }

    public function create()
    {
        return view('admin.class-subjects.create', [
            'classes' => SchoolClass::orderBy('Class_Name')->get(),
            'subjects' => Subject::orderBy('Subject_Name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Class_ID' => ['required', 'exists:classes,Class_ID'],
            'Subject_ID' => ['required', 'exists:subjects,Subject_ID'],
        ]);

        ClassSubject::updateOrCreate(
            [
                'Class_ID' => $validated['Class_ID'],
                'Subject_ID' => $validated['Subject_ID'],
            ],
            ['Teacher_ID' => null]
        );

        return redirect()->route('admin.class-subjects.index')
            ->with('success', 'Class subject mapping saved.');
    }

    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();

        return back()->with('success', 'Mapping removed.');
    }
}
