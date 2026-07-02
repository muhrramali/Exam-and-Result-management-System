@extends('layouts.app')
@section('page-title', 'Re-check requests')
@section('content')
<div class="card mb-4">
    <div class="card-header"><h2 class="card-title">Submit new request</h2></div>
  @if ($publishedExamIds->isEmpty())
        <div class="card-body">
            <p class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-md p-3">
                No published results yet. Ask admin to generate and publish your result cards first.
            </p>
            <a href="{{ route('student.results.index') }}" class="link-action mt-3 inline-block">View my results →</a>
        </div>
    @elseif ($marks->isEmpty())
        <div class="card-body">
            <p class="text-sm text-slate-600">
                All subjects with published results already have a pending re-check request, or no marks are on file.
            </p>
        </div>
    @else
        <form action="{{ route('student.recheck.store') }}" method="POST" class="card-body space-y-3">
            @csrf
            <div class="form-group">
                <label class="label" for="marks_id">Subject mark to review</label>
                <select id="marks_id" name="Marks_ID" class="select" required>
                    <option value="" disabled selected>— Choose exam & subject —</option>
                    @foreach ($marks as $mark)
                        <option value="{{ $mark->Marks_ID }}" @selected(old('Marks_ID') == $mark->Marks_ID)>
                            {{ $mark->examSchedule->exam->Exam_Name }} — {{ $mark->examSchedule->subject->Subject_Name }}
                            ({{ number_format($mark->Obtained_Marks, 0) }}/{{ $mark->examSchedule->Max_Marks }}, Grade {{ $mark->Grade }})
                        </option>
                    @endforeach
                </select>
                @error('Marks_ID')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="label" for="reason">Reason</label>
                <textarea id="reason" name="Reason" class="input" rows="3" required placeholder="Explain why you need a re-check…">{{ old('Reason') }}</textarea>
                @error('Reason')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-primary">Submit request</button>
        </form>
    @endif
</div>
<div class="card">
    <div class="card-header"><h2 class="card-title">My requests</h2></div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Exam</th><th>Subject</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
                @forelse ($requests as $req)
                    <tr>
                        <td>{{ $req->studentMark->examSchedule->exam->Exam_Name }}</td>
                        <td>{{ $req->studentMark->examSchedule->subject->Subject_Name }}</td>
                        <td><span class="badge-gray">{{ $req->Status }}</span></td>
                        <td>{{ $req->Request_Date?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty-state">No requests yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
