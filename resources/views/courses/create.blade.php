@extends('layouts.app')

@section('title', 'Add Course')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Course</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Course ID *</label>
                    <input type="text" name="course_id" class="form-control" value="{{ old('course_id') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course Name *</label>
                    <input type="text" name="course_name" class="form-control" value="{{ old('course_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course Code *</label>
                    <input type="text" name="course_code" class="form-control" value="{{ old('course_code') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Field *</label>
                    <select name="field" class="form-control" required>
                        <option value="">Select Field</option>
                        <option value="Science" {{ old('field') == 'Science' ? 'selected' : '' }}>Science</option>
                        <option value="Commerce" {{ old('field') == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                        <option value="Arts" {{ old('field') == 'Arts' ? 'selected' : '' }}>Arts</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Select Subjects (Optional)</label>
                    <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                        @forelse($subjects as $subject)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject{{ $subject->id }}">
                                <label class="form-check-label" for="subject{{ $subject->id }}">
                                    <strong>{{ $subject->subject_code }}</strong> - {{ $subject->subject_name }}
                                    @if($subject->course)
                                        <span class="badge bg-warning text-dark">Currently in: {{ $subject->course->course_name }}</span>
                                    @endif
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">No subjects available. Please create subjects first.</p>
                        @endforelse
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Save Course</button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
