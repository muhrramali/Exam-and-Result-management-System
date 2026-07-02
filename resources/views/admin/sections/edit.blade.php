@extends('layouts.app')
@section('page-title', 'Edit section')
@section('content')
<div class="max-w-md">
    <form action="{{ route('admin.sections.update', $section) }}" method="POST" class="card card-body space-y-4">@csrf @method('PUT')
        <div><label class="label">Section name</label><input name="Section_Name" value="{{ old('Section_Name', $section->Section_Name) }}" required class="input"></div>
        <div><label class="label">Class</label><select name="Class_ID" required class="select">@foreach ($classes as $c)<option value="{{ $c->Class_ID }}" @selected(old('Class_ID', $section->Class_ID) == $c->Class_ID)>{{ $c->Class_Name }}</option>@endforeach</select></div>
        <div class="form-actions"><button class="btn-primary">Update</button></div>
    </form>
</div>
@endsection
