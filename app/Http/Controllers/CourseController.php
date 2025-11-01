<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $courses = Course::with('subjects')->when($search, function ($query) use ($search) {
            return $query->where('course_name', 'like', "%{$search}%")
                         ->orWhere('course_code', 'like', "%{$search}%")
                         ->orWhere('course_id', 'like', "%{$search}%");
        })->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('courses.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|unique:courses,course_id',
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'field' => 'required|in:Science,Commerce,Arts',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id'
        ]);

        $course = Course::create($request->only('course_id', 'course_name', 'course_code', 'field'));

        if ($request->subjects) {
            $course->subjects()->sync($request->subjects);
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $subjects = Subject::all();
        return view('courses.edit', compact('course', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'course_id' => 'required|unique:courses,course_id,' . $course->id,
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'field' => 'required|in:Science,Commerce,Arts',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id'
        ]);

        $course->update($request->only('course_id', 'course_name', 'course_code', 'field'));

        $course->subjects()->sync($request->subjects ?? []);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->subjects()->detach();
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
    public function exportText()
{
    $courses = \App\Models\Course::with('subjects')->get();

    $text = "COURSE LIST\n";
    $text .= "=========================\n\n";

    foreach ($courses as $course) {
        $text .= "Course ID: {$course->course_id}\n";
        $text .= "Course Name: {$course->course_name}\n";
        $text .= "Course Code: {$course->course_code}\n";
        $text .= "Field: {$course->field}\n";

        if ($course->subjects->count() > 0) {
            $text .= "Subjects:\n";
            foreach ($course->subjects as $subject) {
                $text .= " - {$subject->subject_name} ({$subject->subject_code})\n";
            }
        } else {
            $text .= "Subjects: None\n";
        }

        $text .= "-------------------------\n";
    }

    $fileName = "courses_" . date('Y-m-d_H-i-s') . ".txt";
    return response($text)
        ->header('Content-Type', 'text/plain')
        ->header('Content-Disposition', "attachment; filename={$fileName}");
}

}
