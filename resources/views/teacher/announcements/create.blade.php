@extends('layouts.app')

@section('content')
<h2>Post Announcement</h2>

<form method="POST" action="{{ route('teacher.announcements.store') }}" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title *</label>
        <input name="title" type="text" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Message *</label>
        <textarea name="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Send To:</label><br>
        <label class="me-3"><input type="checkbox" name="to_students" value="1"> Students</label>
        <label><input type="checkbox" name="to_parents" value="1"> Parents</label>
         @error('send_to')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success">Publish</button>
    <a href="{{ route('teacher.announcements.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
