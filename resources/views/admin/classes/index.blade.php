@extends('layouts.app')
@section('page-title', 'Classes')
@section('content')
<div class="toolbar">
    <a href="{{ route('admin.classes.create') }}" class="btn-primary">+ Add class</a>
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Class</th><th>Capacity</th><th>Year</th><th>Sections</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td class="font-medium">{{ $class->Class_Name }}</td>
                        <td>{{ $class->Capacity }}</td>
                        <td class="text-slate-500">{{ $class->academicYear->Session ?? '—' }}</td>
                        <td><span class="badge-gray">{{ $class->sections_count }}</span></td>
                        <td class="text-right">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="link-action">Edit</a>
                            <span class="text-slate-300">·</span>
                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="link-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $classes->links() }}
</div>
@endsection
