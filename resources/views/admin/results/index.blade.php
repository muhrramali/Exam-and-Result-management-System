@extends('layouts.app')
@section('page-title', 'Result cards')
@section('page-subtitle', 'Generate, publish, and view results')
@section('content')
@php $selectedExam = $exams->firstWhere('Exam_ID', $examId); @endphp
<div class="toolbar flex-wrap gap-2">
    <form method="GET" class="inline">
        <select name="exam_id" class="input w-auto" onchange="this.form.submit()">
            @foreach ($exams as $exam)
                <option value="{{ $exam->Exam_ID }}" @selected($examId == $exam->Exam_ID)>{{ $exam->Exam_Name }}</option>
            @endforeach
        </select>
    </form>
    @if ($selectedExam)
        <form action="{{ route('admin.results.generate', $selectedExam) }}" method="POST" class="inline">@csrf<button class="btn-secondary">Generate</button></form>
        <form action="{{ route('admin.results.publish', $selectedExam) }}" method="POST" class="inline">@csrf<button class="btn-secondary">Publish</button></form>
        <form action="{{ route('admin.results.unpublish', $selectedExam) }}" method="POST" class="inline">@csrf<button class="btn-secondary">Unpublish</button></form>
    @endif
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Student</th><th>Class</th><th>Total</th><th>%</th><th>Grade</th><th>Rank</th><th>Pass</th><th>Published</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($resultCards as $card)
                    <tr>
                        <td class="font-medium">{{ $card->student->Full_Name }}</td>
                        <td>{{ $card->student->section->schoolClass->Class_Name ?? '—' }}</td>
                        <td>{{ number_format($card->Total_Marks, 2) }}</td>
                        <td>{{ number_format($card->Percentage, 2) }}%</td>
                        <td>{{ $card->Overall_Grade }}</td>
                        <td>#{{ $card->Class_Rank ?? '—' }}</td>
                        <td><span class="{{ $card->Pass_Status ? 'text-green-600' : 'text-red-600' }}">{{ $card->Pass_Status ? 'Pass' : 'Fail' }}</span></td>
                        <td>{{ $card->Is_Published ? 'Yes' : 'No' }}</td>
                        <td class="text-right"><a href="{{ route('admin.reports.result-card', $card) }}" class="link-action">Card</a></td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="empty-state">No results. Generate from an exam page.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $resultCards->links() }}
</div>
@endsection
