<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('Subject_Name')->paginate(15);

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Subject_Code' => ['required', 'string', 'max:20', 'unique:subjects,Subject_Code'],
            'Subject_Name' => ['required', 'string', 'max:100'],
            'Credits' => ['required', 'integer', 'min:1'],
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'Subject_Code' => ['required', 'string', 'max:20', 'unique:subjects,Subject_Code,'.$subject->Subject_ID.',Subject_ID'],
            'Subject_Name' => ['required', 'string', 'max:100'],
            'Credits' => ['required', 'integer', 'min:1'],
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
