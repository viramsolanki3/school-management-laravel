<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $teachers = Teacher::latest()->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:teachers,email',
            'password' => 'required|string|min:6',
            'subject'=>'nullable|string|max:50',
        ]);
            // 1️⃣ Create a login account in users table
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'teacher',
        ]);

        Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
        ]);
        return redirect()->route('admin.teachers.index')->with('success','Teacher created');
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
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
         return view('admin.teachers.edit', compact('teacher'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"required|email|unique:teachers,email,{$teacher->id}",
            'subject'=>'nullable|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);
        $teacher->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
        ]);
          $user = User::where('email', $teacher->getOriginal('email'))->first();

        if ($user) {
            $user->name = $data['name'];
            $user->email = $data['email'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
        }
        return redirect()->route('admin.teachers.index')->with('success','Teacher updated');
    }

    /**
     * Remove the specified resource from storage.
     */
       public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back()->with('success','Teacher deleted');
    }
}
