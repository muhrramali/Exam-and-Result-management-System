<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\SchoolClass;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['schoolClass', 'students'])
            ->withCount('students')
            ->orderBy('Class_ID')
            ->paginate(15);

        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create', [
            'classes' => SchoolClass::orderBy('Class_Name')->get(),
        ]);
    }

    public function store(StoreSectionRequest $request)
    {
        Section::create($request->validated());

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', [
            'section' => $section,
            'classes' => SchoolClass::orderBy('Class_Name')->get(),
        ]);
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->validated());

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        if ($section->students()->exists()) {
            return back()->with('error', 'Cannot delete section with assigned students.');
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
