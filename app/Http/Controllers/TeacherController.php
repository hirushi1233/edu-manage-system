<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Show all teachers
   public function index()
{
    $teachers = Teacher::with(['subject1', 'subject2'])->latest()->paginate(10);
    return view('teachers.index', compact('teachers'));
}


    // Show create form
    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    // Store new teacher
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|unique:teachers,teacher_id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'nic' => 'required|string|unique:teachers,nic',
            'phone_1' => 'required|string',
            'phone_2' => 'nullable|string',
            'subject_1_id' => 'nullable|exists:subjects,id',
            'subject_2_id' => 'nullable|exists:subjects,id',
            'grade_1' => 'nullable|string',
            'grade_2' => 'nullable|string',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')
                         ->with('success', 'Teacher created successfully!');
    }

    // Show a single teacher
    public function show($id)
    {
        $teacher = Teacher::with(['subject1', 'subject2'])->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    // Show edit form
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    // Update teacher
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'teacher_id' => 'required|unique:teachers,teacher_id,' . $teacher->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'nic' => 'required|string|unique:teachers,nic,' . $teacher->id,
            'phone_1' => 'required|string',
            'phone_2' => 'nullable|string',
            'subject_1_id' => 'nullable|exists:subjects,id',
            'subject_2_id' => 'nullable|exists:subjects,id',
            'grade_1' => 'nullable|string',
            'grade_2' => 'nullable|string',
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')
                         ->with('success', 'Teacher updated successfully!');
    }

    // Delete teacher
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')
                         ->with('success', 'Teacher deleted successfully!');
    }
}
