@extends('layouts.app')
@section('page-title', $student->Full_Name)
@section('page-subtitle', 'Roll ' . $student->Roll_No)
@section('content')
<div class="max-w-xl card">
    <div class="card-body">
        <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
            <div><dt class="label mb-0">Email</dt><dd class="font-medium">{{ $student->user?->email }}</dd></div>
            <div><dt class="label mb-0">Gender</dt><dd class="font-medium">{{ $student->Gender ?? '—' }}</dd></div>
            <div><dt class="label mb-0">DOB</dt><dd class="font-medium">{{ $student->Date_Of_Birth?->format('d M Y') ?? '—' }}</dd></div>
            <div><dt class="label mb-0">Contact</dt><dd class="font-medium">{{ $student->Contact ?? '—' }}</dd></div>
            <div class="col-span-2"><dt class="label mb-0">Section</dt><dd class="mt-1">
                @if ($student->section)
                    <span class="badge-indigo">{{ $student->section->schoolClass->Class_Name }} — {{ $student->section->Section_Name }}</span>
                @else Unassigned @endif
            </dd></div>
        </dl>
        <div class="form-actions mt-2">
            <a href="{{ route('admin.students.edit', $student) }}" class="btn-primary">Edit</a>
            <a href="{{ route('admin.students.index') }}" class="btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
