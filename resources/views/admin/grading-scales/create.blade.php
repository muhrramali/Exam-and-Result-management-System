@extends('layouts.app')
@section('page-title', 'Add grading scale')
@section('content')
<div class="card max-w-md">
    <form action="{{ route('admin.grading-scales.store') }}" method="POST" class="card-body space-y-3">
        @csrf
        <div class="form-group"><label class="label">Grade letter</label><input name="Grade_Letter" class="input" required></div>
        <div class="form-group"><label class="label">Min percent</label><input type="number" step="0.01" name="Min_Percent" class="input" required></div>
        <div class="form-group"><label class="label">Max percent</label><input type="number" step="0.01" name="Max_Percent" class="input" required></div>
        <div class="form-group"><label class="label">Grade point</label><input type="number" step="0.01" name="Grade_Point" class="input" required></div>
        <button class="btn-primary">Save</button>
    </form>
</div>
@endsection
