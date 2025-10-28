@extends('layouts.app')

@section('title', 'Grades')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Grades</h1>
        <a href="{{ route('grades.create') }}" class="btn btn-info">
            <i class="fas fa-plus"></i> Add Grade
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th> <!-- show primary key -->
                            <th>Grade Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                        <tr>
                            <td>{{ $grade->id }}</td> <!-- display ID -->
                            <td>{{ $grade->grade_name }}</td>
                            <td>
                                <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
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
                            <td colspan="3" class="text-center">No grades found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $grades->links() }}
        </div>
    </div>
</div>
@endsection
