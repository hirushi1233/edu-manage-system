<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display all students with optional search
    public function index(Request $request)
    {
        $search = $request->get('search');
        $students = Student::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('student_id', 'like', "%{$search}%")
                         ->orWhere('grade', 'like', "%{$search}%");
        })->paginate(10);

        return view('students.index', compact('students'));
    }

    // Show form to create a new student
    public function create()
    {
        return view('students.create');
    }

    // Store a new student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|unique:students,student_id',
            'grade' => 'required|string|max:10',
            'address' => 'required|string',
            'parent_phone_1' => 'required|string',
            'parent_phone_2' => 'nullable|string',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // Show form to edit a student
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Update the student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|unique:students,student_id,' . $student->id,
            'grade' => 'required|string|max:10',
            'address' => 'required|string',
            'parent_phone_1' => 'required|string',
            'parent_phone_2' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Optional: Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    // Optional: Show single student
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }
}
