<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Http\Request;

class ParentController extends Controller
{
      public function __construct()
    {
        $this->middleware(['auth','isTeacher']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $parents = ParentModel::latest()->paginate(15);
        return view('teacher.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $students = Student::all();
        return view('teacher.parents.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'nullable|email|unique:parents,email',
            'phone' => 'nullable|digits_between:1,12|regex:/^[0-9]+$/',
            'student_id'=>'nullable|exists:students,id',
        ]);
        ParentModel::create($data);
        return redirect()->route('teacher.parents.index')->with('success','Parent added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(ParentModel $parent)
    {
        $students = Student::all();
        return view('teacher.parents.edit', compact('parent','students'));
    }


    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, ParentModel $parent)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"nullable|email|unique:parents,email,{$parent->id}",
             'phone'=> 'nullable|digits_between:1,12|regex:/^[0-9]+$/',
            'student_id'=>'nullable|exists:students,id',
        ]);
        $parent->update($data);
        return redirect()->route('teacher.parents.index')->with('success','Parent updated');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(ParentModel $parent)
    {
        $parent->delete();
        return back()->with('success','Parent deleted');
    }
}
