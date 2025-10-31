@extends('layouts.app')

@section('content')
<h2>Add New Student</h2>

<form method="POST" action="{{ route('teacher.students.store') }}" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Class</label>
        <input type="text" name="class" class="form-control" placeholder="e.g., 10-A">
    </div>

    <div class="mb-3">
        <label class="form-label">Parent</label>
        <select name="parent_id" class="form-select">
            <option value="">Select Parent</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Create Student</button>
    <a href="{{ route('teacher.students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
