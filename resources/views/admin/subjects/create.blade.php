@extends('layouts.app')
@section('page-title', 'Add subject')
@section('content')
<div class="card max-w-md">
    <form action="{{ route('admin.subjects.store') }}" method="POST" class="card-body space-y-3">
        @csrf
        <div class="form-group"><label class="label">Code</label><input name="Subject_Code" class="input" required></div>
        <div class="form-group"><label class="label">Name</label><input name="Subject_Name" class="input" required></div>
        <div class="form-group"><label class="label">Credits</label><input type="number" name="Credits" class="input" value="3" min="1" required></div>
        <button class="btn-primary">Save</button>
    </form>
</div>
@endsection
