@extends('layouts.app')
@section('page-title', 'Add schedule')
@section('page-subtitle', $exam->Exam_Name)
@section('content')
<div class="card max-w-xl">
    <form action="{{ route('admin.exams.schedules.store', $exam) }}" method="POST" class="card-body space-y-4">
        @csrf
        <div class="form-group">
            <label class="label">Class</label>
            <select name="Class_ID" class="input" required>
                @foreach ($classes as $class)
                    <option value="{{ $class->Class_ID }}">{{ $class->Class_Name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label">Subject</label>
            <select name="Subject_ID" class="input" required>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->Subject_ID }}">{{ $subject->Subject_Name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label">Exam type</label>
            <select name="Exam_Type_ID" class="input" required>
                @foreach ($examTypes as $type)
                    <option value="{{ $type->Exam_Type_ID }}">{{ $type->Type_Name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label">Exam date</label>
            <input type="date" name="Exam_Date" class="input" required>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="label">Max marks</label>
                <input type="number" name="Max_Marks" class="input" value="100" min="1" required>
            </div>
            <div class="form-group">
                <label class="label">Duration (minutes)</label>
                <input type="number" name="Duration_Minutes" class="input" value="180" min="15" required>
            </div>
        </div>
        <button type="submit" class="btn-primary">Save schedule</button>
    </form>
</div>
@endsection
