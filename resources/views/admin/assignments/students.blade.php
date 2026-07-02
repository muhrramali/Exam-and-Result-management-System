@extends('layouts.app')
@section('page-title', 'Assign sections')
@section('page-subtitle', 'Link students to class sections')
@section('content')
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Roll</th><th>Name</th><th>Current</th><th>Assign</th></tr></thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="font-medium">{{ $student->Roll_No }}</td>
                        <td>{{ $student->Full_Name }}</td>
                        <td>
                            @if ($student->section)
                                <span class="badge-indigo">{{ $student->section->schoolClass->Class_Name }}-{{ $student->section->Section_Name }}</span>
                            @else <span class="text-slate-400">—</span> @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.assignments.students.update', $student) }}" method="POST" class="flex flex-wrap items-center gap-2">@csrf @method('PATCH')
                                <select name="Section_ID" class="select max-w-[200px]">
                                    <option value="">Unassigned</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->Section_ID }}" @selected($student->Section_ID == $section->Section_ID)>{{ $section->schoolClass->Class_Name }}-{{ $section->Section_Name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn-primary btn-sm">Save</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-t">{{ $students->links() }}</div>
</div>
@endsection
