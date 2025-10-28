<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::orderBy('id', 'asc')->paginate(10);
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade_name' => 'required|string|max:255|unique:grades,grade_name',
        ]);

        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Grade added successfully!');
    }

    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'grade_name' => 'required|string|max:255|unique:grades,grade_name,' . $grade->id,
        ]);

        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully!');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
    }
}
