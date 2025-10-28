<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Grade;

class ClassController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    
    $classes = ClassModel::with('grade')
        ->when($search, function($query) use ($search) {
            return $query->where('class_name', 'like', "%{$search}%")
                         ->orWhere('class_id', 'like', "%{$search}%");
        })
        ->paginate(10);
    
    return view('classes.index', compact('classes'));
}

    public function create()
    {
        $grades = Grade::all();
        return view('classes.create', compact('grades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|unique:classes,class_id',
            'class_name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
        ]);

        ClassModel::create($validated);

        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $grades = Grade::all();
        return view('classes.edit', compact('class', 'grades'));
    }

    public function update(Request $request, $id)
    {
        $class = ClassModel::findOrFail($id);

        $validated = $request->validate([
            'class_id' => 'required|unique:classes,class_id,' . $class->id,
            'class_name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

   public function destroy($id)
{
    $class = ClassModel::findOrFail($id);
    $className = $class->class_name;
    $class->delete();

    return redirect()->route('classes.index')
                     ->with('success', "Class '{$className}' deleted successfully!");
}
}
