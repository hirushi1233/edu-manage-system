@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Student Details</h1>
        <div>
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Student ID:</strong>
                    <p>{{ $student->student_id }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Name:</strong>
                    <p>{{ $student->name }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>Address:</strong>
                    <p>{{ $student->address }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Parent Phone 1:</strong>
                    <p>{{ $student->parent_phone_1 }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Parent Phone 2:</strong>
                    <p>{{ $student->parent_phone_2 ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Grade:</strong>
                    <p>{{ $student->grade }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection