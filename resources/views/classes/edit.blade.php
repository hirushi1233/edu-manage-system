@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Class</h1>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Classes
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('classes.update', $class->id) }}" id="classForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Class ID *</label>
                    <input type="text" name="class_id" class="form-control @error('class_id') is-invalid @enderror" 
                           value="{{ old('class_id', $class->class_id) }}" required>
                    @error('class_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Class Name *</label>
                    <input type="text" name="class_name" class="form-control @error('class_name') is-invalid @enderror" 
                           value="{{ old('class_name', $class->class_name) }}" required>
                    @error('class_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Grade *</label>
                    <select name="grade_id" class="form-control @error('grade_id') is-invalid @enderror" required>
                        <option value="">-- Select Grade --</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $class->grade_id) == $grade->id ? 'selected' : '' }}>
                                {{ $grade->grade_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning" id="submitBtn">
                        <i class="fas fa-save"></i> Update Class
                    </button>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Prevent double submission
    let formSubmitted = false;
    
    document.getElementById('classForm').addEventListener('submit', function(e) {
        if (formSubmitted) {
            e.preventDefault();
            return false;
        }
        
        formSubmitted = true;
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
    });
</script>
@endsection