@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Teachers</h5>
                    <h2>{{ \App\Models\Teacher::count() }}</h2>
                    <a href="{{ route('teachers.index') }}" class="btn btn-light btn-sm">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <h2>{{ \App\Models\Student::count() }}</h2>
                    <a href="{{ route('students.index') }}" class="btn btn-light btn-sm">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Subjects</h5>
                    <h2>{{ \App\Models\Subject::count() }}</h2>
                    <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Classes</h5>
                    <h2>{{ \App\Models\ClassModel::count() }}</h2>
                    <a href="{{ route('classes.index') }}" class="btn btn-light btn-sm">View All</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger">
                 <div class="card-body">
                    <h5 class="card-title">Grades</h5>
                    <h2>{{ \App\Models\Grade::count() }}</h2>
                     <a href="{{ route('grades.index') }}" class="btn btn-light btn-sm">View All</a>
                 </div>
           </div>
       </div>

    </div>
</div>
@endsection