<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecheckRequest;
use App\Services\AuditService;
use App\Services\ResultCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecheckRequestController extends Controller
{
    public function __construct(
        protected ResultCalculationService $results,
        protected AuditService $audit
    ) {}

    public function index()
    {
        $requests = RecheckRequest::with([
            'student',
            'studentMark.examSchedule.subject',
            'studentMark.examSchedule.exam',
        ])
            ->latest('Request_Date')
            ->paginate(20);

        return view('admin.recheck.index', compact('requests'));
    }

    public function update(Request $request, RecheckRequest $recheckRequest)
    {
        $validated = $request->validate([
            'Status' => ['required', 'in:Approved,Rejected'],
            'New_Marks' => ['required_if:Status,Approved', 'nullable', 'numeric', 'min:0'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        if ($validated['Status'] === 'Rejected') {
            $recheckRequest->update(['Status' => 'Rejected']);

            return back()->with('success', 'Re-check request rejected.');
        }

        $mark = $recheckRequest->studentMark;
        $max = $mark->examSchedule->Max_Marks;

        if ($validated['New_Marks'] > $max) {
            return back()->withErrors(['New_Marks' => "Marks cannot exceed {$max}."]);
        }

        DB::transaction(function () use ($recheckRequest, $validated, $mark) {
            $old = $mark->only(['Obtained_Marks', 'Grade', 'Percentage']);

            $mark->update(['Obtained_Marks' => $validated['New_Marks']]);
            $this->results->syncMark($mark);

            $this->audit->log(
                'student_marks',
                $mark->Marks_ID,
                $old,
                $mark->fresh()->only(['Obtained_Marks', 'Grade', 'Percentage']),
                'Re-check approved: '.($validated['admin_note'] ?? $recheckRequest->Reason)
            );

            $recheckRequest->update([
                'Status' => 'Approved',
                'New_Marks' => $validated['New_Marks'],
            ]);

            $this->results->recalculateStudentExam(
                $recheckRequest->Student_ID,
                $mark->examSchedule->Exam_ID
            );
        });

        return back()->with('success', 'Re-check approved and marks updated.');
    }
}
