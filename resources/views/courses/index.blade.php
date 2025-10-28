@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-secondary">
            <i class="fas fa-plus"></i> Add Course
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by ID, code, or name..." value="{{ request('search') }}">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Field</th>
                            <th>Subjects</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td>{{ $course->course_id }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_code }}</td>
                            <td><span class="badge bg-primary">{{ $course->field }}</span></td>
                            <td><span class="badge bg-info">{{ $course->subjects->count() }} subjects</span></td>
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No courses found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection