@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>My Students</h2>
    <a href="{{ route('teacher.students.create') }}" class="btn btn-primary">Add Student</a>
</div>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->class ?? '-' }}</td>
            <td>
                <a href="{{ route('teacher.students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('teacher.students.destroy', $student) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete student?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted">No students found.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $students->links() }}
@endsection
