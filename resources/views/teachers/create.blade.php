@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Teacher</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There are some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('teachers.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher ID *</label>
                        <input type="text" name="teacher_id" class="form-control" value="{{ old('teacher_id') }}" required>
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
                        <label class="form-label">NIC *</label>
                        <input type="text" name="nic" class="form-control" value="{{ old('nic') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone 1 *</label>
                        <input type="text" name="phone_1" class="form-control" value="{{ old('phone_1') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone 2</label>
                        <input type="text" name="phone_2" class="form-control" value="{{ old('phone_2') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject 1</label>
                        <select name="subject_1_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_1_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject_name }} ({{ $subject->subject_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject 2</label>
                        <select name="subject_2_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_2_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject_name }} ({{ $subject->subject_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Grade 1</label>
                        <input type="text" name="grade_1" class="form-control" value="{{ old('grade_1') }}" placeholder="e.g., 10">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Grade 2</label>
                        <input type="text" name="grade_2" class="form-control" value="{{ old('grade_2') }}" placeholder="e.g., 11">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Save Teacher</button>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
