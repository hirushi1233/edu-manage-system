<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;


Route::get('/test', function () {
    return 'Hello! Routes are working!';
});

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'showProfileEdit'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    Route::get('/courses/search-subjects', [CourseController::class, 'searchSubjects'])->name('courses.search-subjects');
    Route::get('/courses/export/text', [CourseController::class, 'exportText'])->name('courses.export.text');
    Route::get('/teachers/export', [App\Http\Controllers\TeacherController::class, 'export'])->name('teachers.export');


    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('grades', GradeController::class);
});
