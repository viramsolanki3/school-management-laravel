@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Teachers</h2>
    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add Teacher</a>
</div>

<table class="table table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($teachers as $teacher)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->subject ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this teacher?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted">No teachers found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
