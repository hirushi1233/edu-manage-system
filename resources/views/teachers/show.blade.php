@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Teacher Details</h1>
        <div>
            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Teacher ID:</strong>
                    <p>{{ $teacher->teacher_id }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Name:</strong>
                    <p>{{ $teacher->name }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <strong>Address:</strong>
                    <p>{{ $teacher->address }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>NIC:</strong>
                    <p>{{ $teacher->nic }}</p>
                </div>
            </div>

             <div class="row mb-3">
                <div class="col-md-6">
                    <strong>NIC Front</strong>
                    @if($teacher->nic_front_image)
                        <p><img src ="{{ asset($teacher->nic_front_image) }}" alt="NIC Front" class="img-thumbnail" width="200"></p>
                    @else
                        <p>N/A</p>
                    @endif

                </div>

                <div class="col-md-6">
                    <strong>NIC Back</strong>
                    @if($teacher->nic_back_image)
                        <p><img src ="{{ asset($teacher->nic_back_image) }}" alt="NIC Front" class="img-thumbnail" width="200"></p>
                    @else
                        <p>N/A</p>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Phone 1:</strong>
                    <p>{{ $teacher->phone_1 }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Phone 2:</strong>
                    <p>{{ $teacher->phone_2 ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Subject 1:</strong>
                    <p>
                        @if($teacher->subject1)
                            <span class="badge bg-info">{{ $teacher->subject1->subject_name }} ({{ $teacher->subject1->subject_code }})</span>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Subject 2:</strong>
                    <p>
                        @if($teacher->subject2)
                            <span class="badge bg-info">{{ $teacher->subject2->subject_name }} ({{ $teacher->subject2->subject_code }})</span>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Grade 1:</strong>
                    <p>{{ $teacher->grade_1 ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Grade 2:</strong>
                    <p>{{ $teacher->grade_2 ?? 'N/A' }}</p>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection