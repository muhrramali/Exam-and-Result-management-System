@extends('layouts.app')
@section('page-title', 'My results')
@section('page-subtitle', 'Published result cards only')
@section('content')
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Exam</th><th>Session</th><th>%</th><th>Grade</th><th>Rank</th><th>Status</th><th></th></tr></thead>
            <tbody>
                @forelse ($resultCards as $card)
                    <tr>
                        <td class="font-medium">{{ $card->exam->Exam_Name }}</td>
                        <td>{{ $card->exam->academicYear->Session ?? '—' }}</td>
                        <td>{{ number_format($card->Percentage, 2) }}%</td>
                        <td>{{ $card->Overall_Grade }}</td>
                        <td>#{{ $card->Class_Rank ?? '—' }}</td>
                        <td class="{{ $card->Pass_Status ? 'text-green-600' : 'text-red-600' }}">{{ $card->Pass_Status ? 'Pass' : 'Fail' }}</td>
                        <td class="text-right"><a href="{{ route('student.results.show', $card) }}" class="link-action">View card</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty-state">No published results yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
