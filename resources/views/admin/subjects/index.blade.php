@extends('layouts.app')
@section('page-title', 'Subjects')
@section('content')
<div class="toolbar"><a href="{{ route('admin.subjects.create') }}" class="btn-primary">+ Add subject</a></div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Code</th><th>Name</th><th>Credits</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td class="font-medium">{{ $subject->Subject_Code }}</td>
                        <td>{{ $subject->Subject_Name }}</td>
                        <td>{{ $subject->Credits }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.subjects.edit', $subject) }}" class="link-action">Edit</a>
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="link-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $subjects->links() }}
</div>
@endsection
