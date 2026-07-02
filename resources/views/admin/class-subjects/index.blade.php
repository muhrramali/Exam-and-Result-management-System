@extends('layouts.app')
@section('page-title', 'Class subjects')
@section('page-subtitle', 'Subjects offered per class (for scheduling)')
@section('content')
<div class="toolbar"><a href="{{ route('admin.class-subjects.create') }}" class="btn-primary">+ Add mapping</a></div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Class</th><th>Subject</th><th></th></tr></thead>
            <tbody>
                @foreach ($mappings as $map)
                    <tr>
                        <td>{{ $map->schoolClass->Class_Name }}</td>
                        <td>{{ $map->subject->Subject_Name }}</td>
                        <td class="text-right">
                            <form action="{{ route('admin.class-subjects.destroy', $map) }}" method="POST" class="inline" onsubmit="return confirm('Remove?')">@csrf @method('DELETE')<button class="link-danger">Remove</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $mappings->links() }}
</div>
@endsection
