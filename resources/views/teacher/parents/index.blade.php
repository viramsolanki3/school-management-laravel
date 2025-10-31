@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Parents</h2>
    <a href="{{ route('teacher.parents.create') }}" class="btn btn-primary">Add Parent</a>
</div>

<table class="table table-striped">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($parents as $parent)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $parent->name }}</td>
            <td>{{ $parent->email }}</td>
            <td>{{ $parent->phone ?? '-' }}</td>
            <td>
                <a href="{{ route('teacher.parents.edit', $parent) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('teacher.parents.destroy', $parent) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete parent?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted">No parents found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
