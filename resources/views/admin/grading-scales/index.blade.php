@extends('layouts.app')
@section('page-title', 'Grading scales')
@section('page-subtitle', 'Configurable grade boundaries')
@section('content')
<div class="toolbar"><a href="{{ route('admin.grading-scales.create') }}" class="btn-primary">+ Add grade</a></div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Grade</th><th>Min %</th><th>Max %</th><th>Grade point</th><th></th></tr></thead>
            <tbody>
                @foreach ($scales as $scale)
                    <tr>
                        <td class="font-semibold">{{ $scale->Grade_Letter }}</td>
                        <td>{{ $scale->Min_Percent }}%</td>
                        <td>{{ $scale->Max_Percent }}%</td>
                        <td>{{ $scale->Grade_Point }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.grading-scales.edit', $scale) }}" class="link-action">Edit</a>
                            <form action="{{ route('admin.grading-scales.destroy', $scale) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="link-danger">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
