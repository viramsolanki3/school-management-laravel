<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
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
        $announcements = Announcement::where('author_role','admin')->latest()->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',

        ]);
        $data['author_id'] = Auth::id();
        $data['author_role'] = 'admin';
        $data['to_teachers'] = true;
        Announcement::create($data);
        return redirect()->route('admin.announcements.index')->with('success','Announcement posted to teachers');
    }
    public function teacherAnnouncements()
    {
        $announcements = Announcement::where('author_role','teacher')->latest()->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
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
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }
}
