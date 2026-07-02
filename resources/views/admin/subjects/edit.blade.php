@extends('layouts.app')
@section('page-title', 'Edit subject')
@section('content')
<div class="card max-w-md">
    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="card-body space-y-3">
        @csrf @method('PUT')
        <div class="form-group"><label class="label">Code</label><input name="Subject_Code" class="input" value="{{ $subject->Subject_Code }}" required></div>
        <div class="form-group"><label class="label">Name</label><input name="Subject_Name" class="input" value="{{ $subject->Subject_Name }}" required></div>
        <div class="form-group"><label class="label">Credits</label><input type="number" name="Credits" class="input" value="{{ $subject->Credits }}" required></div>
        <button class="btn-primary">Update</button>
    </form>
</div>
@endsection
