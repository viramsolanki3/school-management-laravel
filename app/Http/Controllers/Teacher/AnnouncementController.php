<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Student;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherAnnouncementMail;

class AnnouncementController extends Controller
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
         $announcements = Announcement::where(function($q) {
            $q->where('to_teachers', true)->orWhere('author_role', 'teacher');
        })->latest()->paginate(15);

        return view('teacher.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('teacher.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'title'        => 'required|string|max:255',
        'message'      => 'required|string',
        'to_students'  => 'nullable|boolean',
        'to_parents'   => 'nullable|boolean',
    ]);
    if (empty($data['to_students']) && empty($data['to_parents']))
    {
        return back()
            ->withInput()
            ->withErrors(['send_to' => 'Please select at least one audience (Students or Parents).']);
    }
    // Create the announcement
    $announcement = \App\Models\Announcement::create([
        'author_id'   => auth()->id(),
        'author_role' => 'teacher',
        'title'       => $data['title'],
        'body'        => $data['message'],
        'to_students' => isset($data['to_students']),
        'to_parents'  => isset($data['to_parents']),
    ]);

    /*
    |--------------------------------------------------------------------------
    | Send Emails
    |--------------------------------------------------------------------------
    */
    if ($announcement->to_students) {
        $students = \App\Models\Student::with('user')->get();
        foreach ($students as $student) {
            if (!empty($student->user?->email)) {
                \Mail::raw("{$announcement->title}\n\n{$announcement->body}", function ($message) use ($student, $announcement) {
                    $message->to($student->user->email)
                        ->subject("New Announcement: {$announcement->title}");
                });
            }
        }
    }

    if ($announcement->to_parents) {
        $parents = \App\Models\ParentModel::with('user')->get();
        foreach ($parents as $parent) {
            if (!empty($parent->user?->email)) {
                \Mail::raw("{$announcement->title}\n\n{$announcement->body}", function ($message) use ($parent, $announcement) {
                    $message->to($parent->user->email)
                        ->subject("New Announcement: {$announcement->title}");
                });
            }
        }
    }

    return redirect()->route('teacher.announcements.index')
        ->with('success', 'Announcement published successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $data = $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',
            'to_students'=>'nullable|boolean',
            'to_parents'=>'nullable|boolean',
            'to_teachers'=>'nullable|boolean',
        ]);

        $data['author_id'] = Auth::id();
        $data['author_role'] = 'teacher';
        // ensure booleans
        $data['to_students'] = $request->has('to_students');
        $data['to_parents'] = $request->has('to_parents');
        $data['to_teachers'] = $request->has('to_teachers');

        $announcement = Announcement::create($data);

        // Send emails synchronously for dev (switch to queue in production)
        if ($data['to_students']) {
            $students = Student::whereNotNull('email')->get();
            foreach ($students as $s) {
                Mail::to($s->email)->queue(new TeacherAnnouncementMail($announcement));
            }
        }

        if ($data['to_parents']) {
            $parents = ParentModel::whereNotNull('email')->get();
            foreach ($parents as $p) {
                Mail::to($p->email)->queue(new TeacherAnnouncementMail($announcement));
            }
        }

        return redirect()->route('teacher.announcements.index')->with('success','Announcement posted and emails queued');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
