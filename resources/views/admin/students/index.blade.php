@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')
@section('page-subtitle', 'Manage student records')

@section('content')
<div class="toolbar">
    <p class="toolbar-meta">{{ $students->total() }} total</p>
    <a href="{{ route('admin.students.create') }}" class="btn-primary">+ Add student</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Section</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td class="font-medium text-slate-900">{{ $student->Roll_No }}</td>
                        <td>{{ $student->Full_Name }}</td>
                        <td class="text-slate-500">{{ $student->user?->email }}</td>
                        <td>
                            @if ($student->section)
                                <span class="badge-indigo">{{ $student->section->schoolClass->Class_Name }}-{{ $student->section->Section_Name }}</span>
                            @else <span class="text-slate-400">—</span> @endif
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <a href="{{ route('admin.students.show', $student) }}" class="link-action">View</a>
                            <span class="text-slate-300">·</span>
                            <a href="{{ route('admin.students.edit', $student) }}" class="link-muted">Edit</a>
                            <span class="text-slate-300">·</span>
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="link-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty-state">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($students->hasPages())
        <div class="border-t border-slate-100">{{ $students->links() }}</div>
    @endif
</div>
@endsection
