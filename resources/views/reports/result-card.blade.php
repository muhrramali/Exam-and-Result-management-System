@extends('layouts.app')

@section('title', 'Result Card')
@section('page-title', 'Result Card')
@section('page-subtitle', $resultCard->exam->Exam_Name ?? 'Exam')

@section('content')
<div class="card {{ ($printMode ?? false) ? '' : 'mb-4' }}">
    <div class="card-body">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-4 border-b border-slate-200 pb-4">
            <div>
                <h1 class="text-lg font-bold text-slate-900">Exam & Result Management System</h1>
                <p class="text-sm text-slate-500">Official Result Card</p>
            </div>
            <div class="text-right text-sm">
                <p><span class="text-slate-500">Exam:</span> <strong>{{ $resultCard->exam->Exam_Name }}</strong></p>
                <p><span class="text-slate-500">Session:</span> {{ $resultCard->exam->academicYear->Session ?? '—' }}</p>
            </div>
        </div>

        <dl class="mb-6 grid grid-cols-2 gap-3 text-sm md:grid-cols-4">
            <div><dt class="label mb-0">Student</dt><dd class="font-medium">{{ $resultCard->student->Full_Name }}</dd></div>
            <div><dt class="label mb-0">Roll No</dt><dd class="font-medium">{{ $resultCard->student->Roll_No }}</dd></div>
            <div><dt class="label mb-0">Class</dt><dd class="font-medium">{{ $resultCard->student->section->schoolClass->Class_Name ?? '—' }}</dd></div>
            <div><dt class="label mb-0">Section</dt><dd class="font-medium">{{ $resultCard->student->section->Section_Name ?? '—' }}</dd></div>
        </dl>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Obtained</th>
                        <th>Max</th>
                        <th>%</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($marks as $mark)
                        <tr>
                            <td>{{ $mark->examSchedule->subject->Subject_Name }}</td>
                            <td>{{ number_format($mark->Obtained_Marks, 2) }}</td>
                            <td>{{ $mark->examSchedule->Max_Marks }}</td>
                            <td>{{ number_format($mark->Percentage, 2) }}%</td>
                            <td><span class="badge-indigo">{{ $mark->Grade }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No marks recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-4 rounded-lg bg-slate-50 p-4 text-sm md:grid-cols-5">
            <div><p class="label mb-0">Total Marks</p><p class="text-lg font-semibold">{{ number_format($resultCard->Total_Marks, 2) }}</p></div>
            <div><p class="label mb-0">Percentage</p><p class="text-lg font-semibold">{{ number_format($resultCard->Percentage, 2) }}%</p></div>
            <div><p class="label mb-0">Overall Grade</p><p class="text-lg font-semibold">{{ $resultCard->Overall_Grade }}</p></div>
            <div><p class="label mb-0">Class Rank</p><p class="text-lg font-semibold">#{{ $resultCard->Class_Rank ?? '—' }}</p></div>
            <div>
                <p class="label mb-0">Status</p>
                <p class="text-lg font-semibold {{ $resultCard->Pass_Status ? 'text-green-600' : 'text-red-600' }}">
                    {{ $resultCard->Pass_Status ? 'Pass' : 'Fail' }}
                </p>
            </div>
        </div>

        @if (!($printMode ?? false))
            <div class="mt-4 flex gap-2">
                <button type="button" onclick="window.print()" class="btn-primary">Print</button>
                <a href="{{ url()->previous() }}" class="btn-secondary">Back</a>
            </div>
        @endif
    </div>
</div>
@endsection
