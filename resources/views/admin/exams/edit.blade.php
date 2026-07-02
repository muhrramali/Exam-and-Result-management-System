@extends('layouts.app')
@section('page-title', 'Edit exam')
@section('content')
<div class="card max-w-xl">
    <form action="{{ route('admin.exams.update', $exam) }}" method="POST" class="card-body space-y-4">
        @csrf @method('PUT')
        @include('admin.exams._form')
        <button type="submit" class="btn-primary">Update exam</button>
    </form>
</div>
@endsection
