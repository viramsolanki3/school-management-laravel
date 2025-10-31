@extends('layouts.app')

@section('content')
<h2>Edit Teacher</h2>

<form method="POST" action="{{ route('admin.teachers.update', $teacher->id) }}" class="mt-3">
    @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', $teacher->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email *</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', $teacher->email) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password (leave blank to keep current)</label>
        <input name="password" type="password" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Subject</label>
        <input name="subject" type="text" class="form-control" value="{{ old('subject', $teacher->subject) }}">
    </div>

    <button class="btn btn-primary">Update Teacher</button>
    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
