@extends('layouts.app')
@section('page-title', 'Enter marks')
@section('page-subtitle', $schedule->schoolClass->Class_Name.' — '.$schedule->subject->Subject_Name)
@section('content')
<div class="card mb-4">
    <form action="{{ route('admin.marks.store', $schedule) }}" method="POST">
        @csrf
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th>Roll</th><th>Student</th><th>Obtained (max {{ $schedule->Max_Marks }})</th><th>Grade</th><th>%</th></tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        @php $mark = $student->studentMarks->first(); @endphp
                        <tr>
                            <td>{{ $student->Roll_No }}</td>
                            <td>{{ $student->Full_Name }}</td>
                            <td>
                                <input type="hidden" name="marks[{{ $loop->index }}][Student_ID]" value="{{ $student->Student_ID }}">
                                <input type="number" step="0.01" name="marks[{{ $loop->index }}][Obtained_Marks]"
                                       value="{{ $mark?->Obtained_Marks }}" class="input w-28" max="{{ $schedule->Max_Marks }}" min="0">
                            </td>
                            <td>{{ $mark?->Grade ?? '—' }}</td>
                            <td>{{ $mark ? number_format($mark->Percentage, 2).'%' : '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 p-4">
            <button type="submit" class="btn-primary">Save all marks</button>
        </div>
    </form>
</div>

@if ($students->contains(fn ($s) => $s->studentMarks->isNotEmpty()))
<div class="card">
    <div class="card-header"><h2 class="card-title">Result corrections (audit trail)</h2></div>
    <div class="card-body space-y-3">
        @foreach ($students as $student)
            @php $mark = $student->studentMarks->first(); @endphp
            @if ($mark)
                <form action="{{ route('admin.marks.correct', $mark) }}" method="POST" class="flex flex-wrap items-end gap-2 border-b border-slate-100 pb-3 last:border-0">
                    @csrf @method('PATCH')
                    <p class="w-full text-sm font-medium text-slate-800">{{ $student->Full_Name }} ({{ $mark->Grade }}, {{ number_format($mark->Percentage, 2) }}%)</p>
                    <div>
                        <label class="label mb-0 text-xs">New marks</label>
                        <input type="number" step="0.01" name="Obtained_Marks" value="{{ $mark->Obtained_Marks }}" class="input w-24" required>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="label mb-0 text-xs">Reason</label>
                        <input type="text" name="Reason" class="input" placeholder="Correction reason" required>
                    </div>
                    <button type="submit" class="btn-secondary text-xs">Apply correction</button>
                </form>
            @endif
        @endforeach
    </div>
</div>
@endif
@endsection
