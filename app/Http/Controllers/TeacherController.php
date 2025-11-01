<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $validated = $request->validate([
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
            'nic_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nic_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Front image
        if ($request->hasFile('nic_front_image')) {
            $path = $request->file('nic_front_image')->store('public/nic');
            $validated['nic_front_image'] = Storage::url($path); // /storage/nic/filename.jpg
        }

        // Back image
        if ($request->hasFile('nic_back_image')) {
            $path = $request->file('nic_back_image')->store('public/nic');
            $validated['nic_back_image'] = Storage::url($path);
        }

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');
    }
    // Show single teacher
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

        $validated = $request->validate([
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
            'nic_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nic_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Replace NIC Front
        if ($request->hasFile('nic_front_image')) {
            if ($teacher->nic_front_image) {
                Storage::delete(str_replace('/storage/', 'public/', $teacher->nic_front_image));
            }
            $path = $request->file('nic_front_image')->store('public/nic');
            $validated['nic_front_image'] = Storage::url($path);
        }

        // Replace NIC Back
        if ($request->hasFile('nic_back_image')) {
            if ($teacher->nic_back_image) {
                Storage::delete(str_replace('/storage/', 'public/', $teacher->nic_back_image));
            }
            $path = $request->file('nic_back_image')->store('public/nic');
            $validated['nic_back_image'] = Storage::url($path);
        }

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    // Delete teacher
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->nic_front_image) {
            Storage::delete('public/nic/' . basename($teacher->nic_front_image));
        }
        if ($teacher->nic_back_image) {
            Storage::delete('public/nic/' . basename($teacher->nic_back_image));
        }

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }

    // Export teachers as text file
    public function export()
    {
        $teachers = Teacher::with(['subject1', 'subject2'])->get();

        $content = "";
        foreach ($teachers as $teacher) {
            $subjects = [];
            if ($teacher->subject1) $subjects[] = $teacher->subject1->subject_name;
            if ($teacher->subject2) $subjects[] = $teacher->subject2->subject_name;
            $subjectList = implode(', ', $subjects) ?: 'N/A';

            $grades = '';
            if ($teacher->grade_1 || $teacher->grade_2) {
                $grades = $teacher->grade_1 . ($teacher->grade_2 ? ', ' . $teacher->grade_2 : '');
            } else {
                $grades = 'N/A';
            }

            $content .= "Teacher ID = {$teacher->teacher_id}\n";
            $content .= "Name = {$teacher->name}\n";
            $content .= "NIC = {$teacher->nic}\n";
            $content .= "Phone = {$teacher->phone_1}\n";
            $content .= "Subjects = {$subjectList}\n";
            $content .= "Grades = {$grades}\n";
            $content .= str_repeat("-", 40) . "\n\n";
        }

        $fileName = 'teachers_' . date('Y_m_d_H_i_s') . '.txt';
        $filePath = storage_path('app/public/' . $fileName);
        file_put_contents($filePath, $content);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
