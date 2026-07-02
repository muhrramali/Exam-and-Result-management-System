@extends('layouts.app')
@section('page-title', 'Edit class')
@section('content')
<div class="max-w-md">
    <form action="{{ route('admin.classes.update', $class) }}" method="POST" class="card card-body space-y-4">@csrf @method('PUT')
        <div><label class="label">Class name</label><input name="Class_Name" value="{{ old('Class_Name', $class->Class_Name) }}" required class="input"></div>
        <div><label class="label">Capacity</label><input type="number" name="Capacity" value="{{ old('Capacity', $class->Capacity) }}" required class="input"></div>
        <div><label class="label">Academic year</label><select name="Academic_Year_ID" required class="select">@foreach ($academicYears as $y)<option value="{{ $y->Year_ID }}" @selected(old('Academic_Year_ID', $class->Academic_Year_ID) == $y->Year_ID)>{{ $y->Session }}</option>@endforeach</select></div>
        <div class="form-actions"><button class="btn-primary">Update</button></div>
    </form>
</div>
@endsection
