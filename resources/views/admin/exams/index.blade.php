@extends('layouts.app')
@section('page-title', 'Exams')
@section('page-subtitle', 'Manage examination sessions')
@section('content')
<div class="toolbar">
    <a href="{{ route('admin.exams.create') }}" class="btn-primary">+ Add exam</a>
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Exam</th><th>Session</th><th>Dates</th><th>Schedules</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td class="font-medium">{{ $exam->Exam_Name }}</td>
                        <td>{{ $exam->academicYear->Session ?? '—' }}</td>
                        <td class="text-slate-500">{{ $exam->Start_Date->format('d M Y') }} – {{ $exam->End_Date->format('d M Y') }}</td>
                        <td><span class="badge-gray">{{ $exam->exam_schedules_count }}</span></td>
                        <td class="text-right whitespace-nowrap">
                            <a href="{{ route('admin.exams.show', $exam) }}" class="link-action">View</a>
                            <span class="text-slate-300">·</span>
                            <a href="{{ route('admin.exams.schedules.index', $exam) }}" class="link-muted">Schedules</a>
                            <span class="text-slate-300">·</span>
                            <a href="{{ route('admin.exams.edit', $exam) }}" class="link-muted">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty-state">No exams yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $exams->links() }}
</div>
@endsection
