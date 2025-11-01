@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Course Details</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Course ID</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="{{ $course->course_id }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Course Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="{{ $course->course_name }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Course Code</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="{{ $course->course_code }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Field</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="{{ $course->field }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Subjects ({{ $course->subjects->count() }})</label>
                <div class="col-sm-10">
                    <ul class="list-group">
                        @forelse($course->subjects as $subject)
                            <li class="list-group-item">{{ $subject->subject_name }} ({{ $subject->subject_code }})</li>
                        @empty
                            <li class="list-group-item text-muted">No subjects assigned</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
