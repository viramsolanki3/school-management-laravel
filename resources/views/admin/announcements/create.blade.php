@extends('layouts.app')

@section('content')
<h2>Create New Announcement</h2>

<form method="POST" action="{{ route('admin.announcements.store') }}" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title *</label>
        <input name="title" type="text" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Message *</label>
        <textarea name="body" rows="4" class="form-control" required></textarea>
    </div>

     <input type="hidden" name="to_teachers" value="1">

    <button class="btn btn-success">Publish</button>
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
