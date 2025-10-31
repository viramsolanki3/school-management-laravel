@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Announcements</h2>
    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">+ New Announcement</a>
</div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Audience</th>
                <th>Posted By</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $announcement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $announcement->title }}</td>
                    <td>
                        @if($announcement->to_teachers) <span class="badge bg-info">Teachers</span> @endif
                        @if($announcement->to_students) <span class="badge bg-success">Students</span> @endif
                        @if($announcement->to_parents) <span class="badge bg-warning text-dark">Parents</span> @endif
                    </td>
                    <td>{{ $announcement->author?->name ?? 'N/A' }}</td>
                    <td>{{ $announcement->created_at->format('d M Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.announcements.destroy',$announcement) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No announcements yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $announcements->links() }}

@endsection
