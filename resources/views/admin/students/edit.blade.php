@extends('layouts.app')
@section('page-title', 'Edit student')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.students.update', $student) }}" method="POST" class="card">
        <div class="card-body space-y-4">
            @csrf @method('PUT')
            @include('admin.students._form')
            <div class="form-actions">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.students.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
