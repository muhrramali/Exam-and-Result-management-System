@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Exam & result management overview')

@section('content')
<div class="mb-5 grid grid-cols-1 gap-3 sm:grid-cols-4">
    <div class="stat-card">
        <p class="stat-label">Students</p>
        <p class="stat-value stat-value-indigo">{{ $totalStudents }}</p>
    </div>
    <div class="stat-card">
        <p class="stat-label">Active exams</p>
        <p class="stat-value stat-value-green">{{ $activeExams }}</p>
    </div>
    <div class="stat-card">
        <p class="stat-label">Published results</p>
        <p class="stat-value stat-value-amber">{{ $publishedResults }}</p>
    </div>
    <div class="stat-card">
        <p class="stat-label">Pending re-checks</p>
        <p class="stat-value text-red-600">{{ $pendingRechecks }}</p>
    </div>
</div>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Quick actions</h2>
        </div>
        <div class="card-body grid grid-cols-2 gap-2">
            <a href="{{ route('admin.exams.create') }}" class="btn-secondary text-center">+ Exam</a>
            <a href="{{ route('admin.results.index') }}" class="btn-secondary text-center">Results</a>
            <a href="{{ route('admin.grading-scales.index') }}" class="btn-secondary text-center">Grading</a>
            <a href="{{ route('admin.reports.class-summary') }}" class="btn-secondary text-center">Class report</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Recent exams</h2>
            <a href="{{ route('admin.exams.index') }}" class="link-action">View all</a>
        </div>
        <div class="table-wrap card-body-flush">
            <table class="table">
                <thead><tr><th>Exam</th><th>Session</th><th>Dates</th></tr></thead>
                <tbody>
                    @forelse ($recentExams as $exam)
                        <tr>
                            <td><a href="{{ route('admin.exams.show', $exam) }}" class="link-action">{{ $exam->Exam_Name }}</a></td>
                            <td>{{ $exam->academicYear->Session ?? '—' }}</td>
                            <td class="text-slate-500">{{ $exam->Start_Date->format('d M') }} – {{ $exam->End_Date->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-state">No exams yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
