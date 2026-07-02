@extends('layouts.app')
@section('page-title', 'Add exam')
@section('content')
<div class="card max-w-xl">
    <form action="{{ route('admin.exams.store') }}" method="POST" class="card-body space-y-4">
        @csrf
        @include('admin.exams._form')
        <button type="submit" class="btn-primary">Save exam</button>
    </form>
</div>
@endsection
