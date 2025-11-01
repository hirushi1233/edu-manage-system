@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Teachers</h1>
            <a href="{{ route('teachers.export') }}" class="btn btn-success me-2">
                <i class="fas fa-file-export"></i> Export as Text
            </a>

        <a href="{{ route('teachers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Teacher
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, ID, or NIC..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
    <tr>
        <th>Teacher ID</th>
        <th>Name</th>
        <th>NIC</th>
        <th>Phone 1</th>
        <th>Subjects</th>
        <th>Grades</th>
        <th>NIC Front</th>
        <th>NIC Back</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @forelse($teachers as $teacher)
    <tr>
        <td>{{ $teacher->teacher_id }}</td>
        <td>{{ $teacher->name }}</td>
        <td>{{ $teacher->nic }}</td>
        <td>{{ $teacher->phone_1 }}</td>
        <td>
            @if($teacher->subject1)
                <span class="badge bg-info">{{ $teacher->subject1->subject_name }}</span>
            @endif
            @if($teacher->subject2)
                <span class="badge bg-info">{{ $teacher->subject2->subject_name }}</span>
            @endif
            @if(!$teacher->subject1 && !$teacher->subject2)
                <span class="text-muted">N/A</span>
            @endif
        </td>
        <td>
            @if($teacher->grade_1 || $teacher->grade_2)
                {{ $teacher->grade_1 }}{{ $teacher->grade_2 ? ', ' . $teacher->grade_2 : '' }}
            @else
                <span class="text-muted">N/A</span>
            @endif
        </td>
        <td>
    @if($teacher->nic_front_image)
        <img src="{{ asset($teacher->nic_front_image) }}" alt="NIC Front" width="80" class="img-thumbnail">
    @else
        <span class="text-muted">N/A</span>
    @endif
</td>
<td>
    @if($teacher->nic_back_image)
        <img src="{{ asset($teacher->nic_back_image) }}" alt="NIC Back" width="80" class="img-thumbnail">
    @else
        <span class="text-muted">N/A</span>
    @endif
</td>
<td>

            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline">
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
        <td colspan="9" class="text-center">No teachers found</td>
    </tr>
    @endforelse
</tbody>

                </table>
            </div>

            {{ $teachers->links() }}
        </div>
    </div>
</div>
@endsection
