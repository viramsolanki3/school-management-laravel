<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') - School Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background: #0d6efd;
      color: white;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      padding: 12px 20px;
      text-decoration: none;
      display: block;
      border-radius: 8px;
      margin: 4px 12px;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.15);
    }
    .sidebar .active {
      background: rgba(255,255,255,0.25);
      font-weight: 600;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }
    .navbar {
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      padding: 10px 20px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h4 class="text-center mb-4 fw-bold">🏫 School</h4>
  @if(auth()->user()->isAdmin())
  <a href="{{ route('admin.teachers.index') }}" class="{{ request()->is('admin/teachers*') ? 'active' : '' }}">👩‍🏫 Teachers</a>
  <a href="{{ route('admin.students.index') }}" class="{{ request()->is('admin/students*') ? 'active' : '' }}">🎓 Students</a>
  <a href="{{ route('admin.parents.index') }}" class="{{ request()->is('admin/parents*') ? 'active' : '' }}">👪 Parents</a>
  <a href="{{ route('admin.teacher-announcements') }}" class="{{ request()->is('admin/teacher-announcements*') ? 'active' : '' }}">📢 Announcements</a>
  @elseif(auth()->user()->isTeacher())
    <a href="{{ route('teacher.students.index') }}" class="{{ request()->is('teacher/students*') ? 'active' : '' }}">🎓 Students</a>
    <a href="{{ route('teacher.parents.index') }}" class="{{ request()->is('teacher/parents*') ? 'active' : '' }}">👪 Parents</a>
    <a href="{{ route('teacher.announcements.index') }}" class="{{ request()->is('teacher/announcements*') ? 'active' : '' }}">📢 Announcements</a>
  @endif
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
  <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
    @csrf
  </form>
</div>

<div class="main-content">
  <nav class="navbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0">@yield('title')</h5>
    <div>
      <span class="fw-semibold">{{ auth()->user()->name }}</span>
    </div>
  </nav>

  @yield('content')
</div>

</body>
</html>
