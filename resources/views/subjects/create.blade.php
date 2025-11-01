@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add Subject</h1>

    {{-- Display success or error messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf

                {{-- Subject Code --}}
                <div class="mb-3">
                    <label class="form-label">Subject Code <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="subject_code" 
                        class="form-control @error('subject_code') is-invalid @enderror" 
                        value="{{ old('subject_code') }}" 
                        placeholder="e.g., ICT01" 
                        required
                    >
                    @error('subject_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Subject Name --}}
                <div class="mb-3">
                    <label class="form-label">Subject Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="subject_name" 
                        class="form-control @error('subject_name') is-invalid @enderror" 
                        value="{{ old('subject_name') }}" 
                        placeholder="e.g., Information Technology" 
                        required
                    >
                    @error('subject_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Buttons --}}
                <div class="d-flex justify-content-start gap-2">
                    <button type="submit" class="btn btn-warning text-white fw-bold px-4">Save Subject</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
