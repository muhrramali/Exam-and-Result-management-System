<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GradingScale;
use Illuminate\Http\Request;

class GradingScaleController extends Controller
{
    public function index()
    {
        $scales = GradingScale::orderByDesc('Min_Percent')->get();

        return view('admin.grading-scales.index', compact('scales'));
    }

    public function create()
    {
        return view('admin.grading-scales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Grade_Letter' => ['required', 'string', 'max:5'],
            'Min_Percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'Max_Percent' => ['required', 'numeric', 'min:0', 'max:100', 'gte:Min_Percent'],
            'Grade_Point' => ['required', 'numeric', 'min:0', 'max:4'],
        ]);

        GradingScale::create($validated);

        return redirect()->route('admin.grading-scales.index')
            ->with('success', 'Grading scale entry added.');
    }

    public function edit(GradingScale $gradingScale)
    {
        return view('admin.grading-scales.edit', ['scale' => $gradingScale]);
    }

    public function update(Request $request, GradingScale $gradingScale)
    {
        $validated = $request->validate([
            'Grade_Letter' => ['required', 'string', 'max:5'],
            'Min_Percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'Max_Percent' => ['required', 'numeric', 'min:0', 'max:100', 'gte:Min_Percent'],
            'Grade_Point' => ['required', 'numeric', 'min:0', 'max:4'],
        ]);

        $gradingScale->update($validated);

        return redirect()->route('admin.grading-scales.index')
            ->with('success', 'Grading scale updated.');
    }

    public function destroy(GradingScale $gradingScale)
    {
        $gradingScale->delete();

        return redirect()->route('admin.grading-scales.index')
            ->with('success', 'Grading scale entry removed.');
    }
}
