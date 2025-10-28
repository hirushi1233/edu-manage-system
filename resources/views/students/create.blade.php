@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Student</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student ID *</label>
                        <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parent Phone 1 *</label>
                        <input type="text" name="parent_phone_1" class="form-control" value="{{ old('parent_phone_1') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parent Phone 2</label>
                        <input type="text" name="parent_phone_2" class="form-control" value="{{ old('parent_phone_2') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grade *</label>
                    <input type="text" name="grade" class="form-control" value="{{ old('grade') }}" placeholder="e.g., Grade 10" required>
                </div>

                <button type="submit" class="btn btn-success">Save Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection