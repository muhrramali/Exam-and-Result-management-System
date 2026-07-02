@extends('layouts.app')
@section('page-title', 'Re-check requests')
@section('content')
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Student</th><th>Subject</th><th>Exam</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                @forelse ($requests as $req)
                    <tr>
                        <td>{{ $req->student->Full_Name }}</td>
                        <td>{{ $req->studentMark->examSchedule->subject->Subject_Name }}</td>
                        <td>{{ $req->studentMark->examSchedule->exam->Exam_Name }}</td>
                        <td class="max-w-xs truncate">{{ $req->Reason }}</td>
                        <td><span class="badge-gray">{{ $req->Status }}</span></td>
                        <td>
                            @if ($req->Status === 'Pending')
                                <form action="{{ route('admin.recheck.update', $req) }}" method="POST" class="space-y-1">
                                    @csrf @method('PATCH')
                                    <input type="number" step="0.01" name="New_Marks" placeholder="New marks" class="input w-24 text-xs" required>
                                    <input type="hidden" name="Status" value="Approved">
                                    <button class="btn-primary text-xs">Approve</button>
                                </form>
                                <form action="{{ route('admin.recheck.update', $req) }}" method="POST" class="mt-1">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="Status" value="Rejected">
                                    <button class="link-danger text-xs">Reject</button>
                                </form>
                            @else
                                {{ $req->New_Marks ? '→ '.$req->New_Marks : '—' }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty-state">No re-check requests.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $requests->links() }}
</div>
@endsection
