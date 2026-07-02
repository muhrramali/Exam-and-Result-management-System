@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Exam results overview')
@section('content')
@if ($student)
<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="card card-body">
        <h2 class="card-title mb-3">{{ $student->Full_Name }}</h2>
        <p class="text-sm text-slate-500">Roll: <strong>{{ $student->Roll_No }}</strong></p>
        @if ($student->section)
            <p class="mt-2 text-lg font-semibold text-indigo-600">{{ $student->section->schoolClass->Class_Name }} — Section {{ $student->section->Section_Name }}</p>
        @endif
    </div>
    <div class="card card-body">
        <h2 class="card-title mb-3">Quick links</h2>
        <a href="{{ route('student.results.index') }}" class="btn-secondary mb-2 block text-center">View published results</a>
        <a href="{{ route('student.recheck.index') }}" class="btn-secondary block text-center">Re-check requests</a>
    </div>
</div>
@if ($latestResult)
<div class="card mt-4">
    <div class="card-header"><h2 class="card-title">Latest published result</h2></div>
    <div class="card-body text-sm">
        <p><strong>{{ $latestResult->exam->Exam_Name }}</strong> — {{ number_format($latestResult->Percentage, 2) }}% ({{ $latestResult->Overall_Grade }})</p>
        <p class="mt-1">Rank #{{ $latestResult->Class_Rank }} · {{ $latestResult->Pass_Status ? 'Pass' : 'Fail' }}</p>
        <a href="{{ route('student.results.show', $latestResult) }}" class="link-action mt-2 inline-block">View result card →</a>
    </div>
</div>
@endif
@else
<div class="alert-error">Student profile not linked. Contact administrator.</div>
@endif
@endsection
