@extends('layouts.app')
@section('page-title', 'Add student')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.students.store') }}" method="POST" class="card">
        <div class="card-body space-y-4">
            @csrf
            @include('admin.students._form', ['student' => null])
            <div class="form-actions">
                <button type="submit" class="btn-primary">Save student</button>
                <a href="{{ route('admin.students.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
