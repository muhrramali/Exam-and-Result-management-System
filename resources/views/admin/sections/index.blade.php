@extends('layouts.app')
@section('page-title', 'Sections')
@section('content')
<div class="toolbar">
    <p class="toolbar-meta">{{ $sections->total() }} sections</p>
    <a href="{{ route('admin.sections.create') }}" class="btn-primary">+ Add section</a>
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Section</th><th>Class</th><th>Students</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td class="font-medium">{{ $section->Section_Name }}</td>
                        <td>{{ $section->schoolClass->Class_Name }}</td>
                        <td><span class="badge-gray">{{ $section->students_count }}</span></td>
                        <td class="text-right">
                            <a href="{{ route('admin.sections.edit', $section) }}" class="link-action">Edit</a>
                            <span class="text-slate-300">·</span>
                            <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="link-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $sections->links() }}
</div>
@endsection
