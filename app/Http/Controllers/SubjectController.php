<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Display all subjects with optional search
    public function index(Request $request)
    {
        $search = $request->get('search');
        $subjects = Subject::with('course')
            ->when($search, function($query) use ($search) {
                return $query->where('subject_name', 'like', "%{$search}%")
                             ->orWhere('subject_code', 'like', "%{$search}%");
            })->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    // Show create form
    public function create()
    {
        $courses = Course::all();
        return view('subjects.create', compact('courses'));
    }

    // Store new subject
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id'
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $courses = Course::all();
        return view('subjects.edit', compact('subject', 'courses'));
    }

    // Update subject
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'subject_code' => 'required|unique:subjects,subject_code,' . $subject->id,
            'subject_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id'
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject updated successfully!');
    }

    // Delete subject
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject deleted successfully!');
    }

    // Show a single subject (optional)
    public function show($id)
    {
        $subject = Subject::with('course')->findOrFail($id);
        return view('subjects.show', compact('subject'));
    }
}