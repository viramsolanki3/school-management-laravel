<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    public function index()
    {
        $students = Student::with('parent')->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }
}
