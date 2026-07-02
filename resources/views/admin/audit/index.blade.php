@extends('layouts.app')
@section('page-title', 'Audit trail')
@section('page-subtitle', 'Mark corrections and changes')
@section('content')
<div class="card">
    <div class="table-wrap">
        <table class="table text-sm">
            <thead><tr><th>Date</th><th>Table</th><th>Record</th><th>Changed by</th><th>Reason</th><th>Old → New</th></tr></thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td class="whitespace-nowrap">{{ $log->Change_Date?->format('d M Y H:i') }}</td>
                        <td>{{ $log->Table_Name }}</td>
                        <td>#{{ $log->Record_ID }}</td>
                        <td>{{ $log->user?->name ?? '—' }}</td>
                        <td>{{ $log->Reason ?? '—' }}</td>
                        <td class="max-w-md truncate text-xs text-slate-500">{{ Str::limit($log->Old_Value, 40) }} → {{ Str::limit($log->New_Value, 40) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty-state">No audit entries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $logs->links() }}
</div>
@endsection
