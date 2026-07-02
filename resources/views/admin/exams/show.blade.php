@extends('layouts.app')
@section('page-title', $exam->Exam_Name)
@section('page-subtitle', 'Exam workflow')
@section('content')
<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('admin.exams.schedules.index', $exam) }}" class="btn-primary">Manage schedules</a>
    <form action="{{ route('admin.results.generate', $exam) }}" method="POST" class="inline">@csrf<button class="btn-secondary">Generate results</button></form>
    <form action="{{ route('admin.results.publish', $exam) }}" method="POST" class="inline">@csrf<button class="btn-secondary">Publish results</button></form>
    <a href="{{ route('admin.results.index', ['exam_id' => $exam->Exam_ID]) }}" class="btn-secondary">View results</a>
</div>
<div class="card">
    <div class="card-header"><h2 class="card-title">Schedules (class × subject)</h2></div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Class</th><th>Subject</th><th>Type</th><th>Date</th><th>Max</th><th></th></tr></thead>
            <tbody>
                @forelse ($exam->examSchedules as $schedule)
                    <tr>
                        <td>{{ $schedule->schoolClass->Class_Name }}</td>
                        <td>{{ $schedule->subject->Subject_Name }}</td>
                        <td>{{ $schedule->examType->Type_Name }}</td>
                        <td>{{ $schedule->Exam_Date->format('d M Y') }}</td>
                        <td>{{ $schedule->Max_Marks }}</td>
                        <td class="text-right"><a href="{{ route('admin.marks.index', $schedule) }}" class="link-action">Enter marks</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty-state">No schedules. Add class/subject schedules first.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
