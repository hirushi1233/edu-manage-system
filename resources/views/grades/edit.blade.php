@extends('layouts.app')

@section('title', 'Edit Grade')

@section('content')
<div class="container">
    <h1>Edit Grade</h1>

    <form method="POST" action="{{ route('grades.update', $grade->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Grade Name</label>
            <input type="text" name="grade_name" class="form-control" value="{{ old('grade_name', $grade->grade_name) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
