@extends('layouts.app')
@section('page-title', 'Edit grading scale')
@section('content')
<div class="card max-w-md">
    <form action="{{ route('admin.grading-scales.update', $scale) }}" method="POST" class="card-body space-y-3">
        @csrf @method('PUT')
        <div class="form-group"><label class="label">Grade letter</label><input name="Grade_Letter" class="input" value="{{ $scale->Grade_Letter }}" required></div>
        <div class="form-group"><label class="label">Min percent</label><input type="number" step="0.01" name="Min_Percent" class="input" value="{{ $scale->Min_Percent }}" required></div>
        <div class="form-group"><label class="label">Max percent</label><input type="number" step="0.01" name="Max_Percent" class="input" value="{{ $scale->Max_Percent }}" required></div>
        <div class="form-group"><label class="label">Grade point</label><input type="number" step="0.01" name="Grade_Point" class="input" value="{{ $scale->Grade_Point }}" required></div>
        <button class="btn-primary">Update</button>
    </form>
</div>
@endsection
