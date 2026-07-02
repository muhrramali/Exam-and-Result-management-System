<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\AcademicYear;
use App\Models\SchoolClass;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with(['academicYear', 'sections'])
            ->withCount('sections')
            ->orderBy('Class_Name')
            ->paginate(15);

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create', [
            'academicYears' => AcademicYear::orderByDesc('Year_ID')->get(),
        ]);
    }

    public function store(StoreSchoolClassRequest $request)
    {
        SchoolClass::create($request->validated());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function edit(SchoolClass $class)
    {
        return view('admin.classes.edit', [
            'class' => $class,
            'academicYears' => AcademicYear::orderByDesc('Year_ID')->get(),
        ]);
    }

    public function update(UpdateSchoolClassRequest $request, SchoolClass $class)
    {
        $class->update($request->validated());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $class)
    {
        if ($class->sections()->exists()) {
            return back()->with('error', 'Cannot delete class with existing sections.');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
