@extends('layouts.app')
@section('page-title', 'Map subject to class')
@section('content')
<div class="card max-w-md">
    <form action="{{ route('admin.class-subjects.store') }}" method="POST" class="card-body space-y-3">
        @csrf
        <div class="form-group">
            <label class="label">Class</label>
            <select name="Class_ID" class="input" required>
                @foreach ($classes as $class)<option value="{{ $class->Class_ID }}">{{ $class->Class_Name }}</option>@endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label">Subject</label>
            <select name="Subject_ID" class="input" required>
                @foreach ($subjects as $subject)<option value="{{ $subject->Subject_ID }}">{{ $subject->Subject_Name }}</option>@endforeach
            </select>
        </div>
        <button class="btn-primary">Save</button>
    </form>
</div>
@endsection
