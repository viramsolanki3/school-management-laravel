<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $students = $teacher ? $teacher->students()->paginate(15) : Student::whereNull('teacher_id')->paginate(15);

        return view('teacher.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = ParentModel::all();
        return view('teacher.students.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'nullable|email|unique:students,email',
            'class' => 'required|string|max:50',
             'parent_id'  => 'nullable|exists:parents,id',
        ]);

        $teacher = Teacher::firstWhere('user_id', Auth::id());
        $data['teacher_id'] = $teacher?->id;
        Student::create($data);

        return redirect()->route('teacher.students.index')->with('success','Student added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Student $student)
    {
        $parents = ParentModel::all();
        return view('teacher.students.edit', compact('student', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"nullable|email|unique:students,email,{$student->id}",
            'class' => 'required|string|max:50',
             'parent_id'  => 'nullable|exists:parents,id',
        ]);
        $student->update($data);
        return redirect()->route('teacher.students.index')->with('success','Student updated');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success','Student deleted');
    }
}
