@extends('layouts.app')
@section('page-title', 'Class performance summary')
@section('page-subtitle', 'Class-wise exam analytics')
@section('content')
<form method="GET" class="toolbar flex-wrap gap-2">
    <select name="exam_id" class="input w-auto">
        @foreach ($exams as $exam)
            <option value="{{ $exam->Exam_ID }}" @selected($examId == $exam->Exam_ID)>{{ $exam->Exam_Name }}</option>
        @endforeach
    </select>
    <select name="class_id" class="input w-auto">
        @foreach ($classes as $class)
            <option value="{{ $class->Class_ID }}" @selected($classId == $class->Class_ID)>{{ $class->Class_Name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary">View report</button>
</form>

@if ($summary)
<div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
    <div class="stat-card"><p class="stat-label">Students</p><p class="stat-value">{{ $summary['total_students'] }}</p></div>
    <div class="stat-card"><p class="stat-label">Passed</p><p class="stat-value text-green-600">{{ $summary['passed'] }}</p></div>
    <div class="stat-card"><p class="stat-label">Failed</p><p class="stat-value text-red-600">{{ $summary['failed'] }}</p></div>
    <div class="stat-card"><p class="stat-label">Class average</p><p class="stat-value">{{ $summary['average_percentage'] }}%</p></div>
</div>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="card">
        <div class="card-header"><h2 class="card-title">Top performers</h2></div>
        <div class="card-body">
            <ol class="list-decimal space-y-1 pl-4 text-sm">
                @foreach ($summary['top_students'] as $card)
                    <li>{{ $card->student->Full_Name }} — {{ number_format($card->Percentage, 2) }}% (Rank #{{ $card->Class_Rank }})</li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h2 class="card-title">Subject-wise performance</h2></div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Subject</th><th>Avg %</th><th>Highest</th><th>Lowest</th></tr></thead>
                <tbody>
                    @foreach ($summary['subject_stats'] as $subject => $stats)
                        <tr>
                            <td>{{ $subject }}</td>
                            <td>{{ $stats['average'] }}%</td>
                            <td>{{ $stats['highest'] }}%</td>
                            <td>{{ $stats['lowest'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<p class="text-sm text-slate-500">Select an exam and class to view the summary.</p>
@endif
@endsection
