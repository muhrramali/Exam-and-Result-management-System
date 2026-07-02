@extends('layouts.app')
@section('page-title', 'Exam schedules')
@section('page-subtitle', $exam->Exam_Name)
@section('content')
<div class="toolbar">
    <a href="{{ route('admin.exams.show', $exam) }}" class="btn-secondary">← Back to exam</a>
    <a href="{{ route('admin.exams.schedules.create', $exam) }}" class="btn-primary">+ Add schedule</a>
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Class</th><th>Subject</th><th>Type</th><th>Date</th><th>Max</th><th>Duration</th><th></th></tr></thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->schoolClass->Class_Name }}</td>
                        <td>{{ $schedule->subject->Subject_Name }}</td>
                        <td>{{ $schedule->examType->Type_Name }}</td>
                        <td>{{ $schedule->Exam_Date->format('d M Y') }}</td>
                        <td>{{ $schedule->Max_Marks }}</td>
                        <td>{{ $schedule->Duration_Minutes }} min</td>
                        <td class="text-right whitespace-nowrap">
                            <a href="{{ route('admin.marks.index', $schedule) }}" class="link-action">Marks</a>
                            <form action="{{ route('admin.exams.schedules.destroy', [$exam, $schedule]) }}" method="POST" class="inline" onsubmit="return confirm('Delete schedule?')">
                                @csrf @method('DELETE')
                                <button class="link-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $schedules->links() }}
</div>
@endsection
