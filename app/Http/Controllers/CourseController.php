<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show all courses
    public function index(Request $request)
    {
        $search = $request->get('search');
        $courses = Course::when($search, function ($query) use ($search) {
            return $query->where('course_name', 'like', "%{$search}%")
                         ->orWhere('course_code', 'like', "%{$search}%")
                         ->orWhere('course_id', 'like', "%{$search}%");
        })->paginate(10);

        return view('courses.index', compact('courses'));
    }

    // Show create form
    public function create()
    {
        $subjects = Subject::all();
        return view('courses.create', compact('subjects'));
    }

    // Store new course
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

        $course = Course::create([
            'course_id' => $request->course_id,
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'field' => $request->field,
        ]);

        if ($request->has('subjects')) {
            Subject::whereIn('id', $request->subjects)->update(['course_id' => $course->id]);
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $subjects = Subject::all();
        return view('courses.edit', compact('course', 'subjects'));
    }

    // Update course
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

        $course->update([
            'course_id' => $request->course_id,
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'field' => $request->field,
        ]);

        Subject::where('course_id', $course->id)->update(['course_id' => null]);
        if ($request->has('subjects')) {
            Subject::whereIn('id', $request->subjects)->update(['course_id' => $course->id]);
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // Delete course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
