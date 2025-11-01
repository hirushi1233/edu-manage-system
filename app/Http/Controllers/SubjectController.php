<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Display all subjects
    public function index(Request $request)
    {
        $search = $request->get('search');
        $subjects = Subject::when($search, function($query) use ($search) {
            return $query->where('subject_name', 'like', "%{$search}%")
                         ->orWhere('subject_code', 'like', "%{$search}%");
        })->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    // Show create form
    public function create()
    {
        return view('subjects.create');
    }

    // Store new subject
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:255',
        ]);

        Subject::create($request->only(['subject_code', 'subject_name']));

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject created successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    // Update subject
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'subject_code' => 'required|unique:subjects,subject_code,' . $subject->id,
            'subject_name' => 'required|string|max:255',
        ]);

        $subject->update($request->only(['subject_code', 'subject_name']));

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject updated successfully!');
    }

    // Delete
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')
                         ->with('success', 'Subject deleted successfully!');
    }

    // Show single subject
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show', compact('subject'));
    }
}
