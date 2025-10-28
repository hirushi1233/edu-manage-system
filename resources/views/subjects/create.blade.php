@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Subject</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Subject Code *</label>
                    <input type="text" name="subject_code" class="form-control @error('subject_code') is-invalid @enderror" value="{{ old('subject_code') }}" placeholder="e.g., ICT01" required>
                    @error('subject_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject Name *</label>
                    <input type="text" name="subject_name" class="form-control @error('subject_name') is-invalid @enderror" value="{{ old('subject_name') }}" placeholder="e.g., Information Technology" required>
                    @error('subject_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Course *</label>
                    <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }} ({{ $course->course_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Save Subject</button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection