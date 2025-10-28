@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Classes</h1>
        <a href="{{ route('classes.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Class
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by class ID or name..." value="{{ request('search') }}">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Class ID</th>
                            <th>Class Name</th>
                            <th>Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                        <tr>
                            <td>{{ $class->class_id }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $class->grade->grade_name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $class->id }}, '{{ $class->class_name }}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                
                                <!-- Hidden form for deletion -->
                                <form id="delete-form-{{ $class->id }}" action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No classes found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($classes, 'links'))
                <div class="mt-3">
                    {{ $classes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(classId, className) {
        Swal.fire({
            title: 'Are you sure?',
            html: `You are about to delete <strong>${className}</strong>.<br>This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-trash me-2"></i>Yes, delete it!',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
            focusCancel: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Deleting...',
                    html: 'Please wait while we delete the class.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit the form
                document.getElementById('delete-form-' + classId).submit();
            }
        });
    }
</script>
@endpush
@endsection