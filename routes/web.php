<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController as AdminTeacher;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncement;
use App\Http\Controllers\Teacher\StudentController as TeacherStudent;
use App\Http\Controllers\Teacher\ParentController as TeacherParent;
use App\Http\Controllers\Teacher\AnnouncementController as TeacherAnnouncement;

/*
|--------------------------------------------------------------------------
| Public / Welcome
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.teachers.index');
        });

        // Manage Teachers
        Route::resource('teachers', AdminTeacher::class);

        // Manage Announcements (Admin → for Teachers)
        Route::resource('announcements', AdminAnnouncement::class)
            ->only(['index', 'create', 'store', 'destroy']);

        // Admin view of all Teacher-created Announcements
        Route::get('teacher-announcements', [AdminAnnouncement::class, 'teacherAnnouncements'])
            ->name('teacher-announcements');
        Route::get('students', [\App\Http\Controllers\Admin\StudentController::class, 'index'])
    ->name('students.index');

// Manage Parents (view all parents created by teachers)
Route::get('parents', [\App\Http\Controllers\Admin\ParentController::class, 'index'])
    ->name('parents.index');
    });

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isTeacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('teacher.students.index');
        });

        // Manage Students
        Route::resource('students', TeacherStudent::class);

        // Manage Parents
        Route::resource('parents', TeacherParent::class);

        // Manage Announcements
        Route::resource('announcements', TeacherAnnouncement::class);
    });

/*
|--------------------------------------------------------------------------
| Dashboard (Post-login Redirect)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isAdmin()) {
        $announcements = \App\Models\Announcement::where('author_role', 'teacher')
            ->latest()
            ->get();
        return view('admin.dashboard', compact('announcements'));
    }

    if ($user->isTeacher()) {
        $announcements = \App\Models\Announcement::where(function ($q) {
            $q->where('to_teachers', true)->orWhere('author_role', 'teacher');
        })
            ->latest()
            ->get();
        return view('teacher.dashboard', compact('announcements'));
    }

    return view('dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
