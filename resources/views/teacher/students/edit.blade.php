@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

<form method="POST" action="{{ route('teacher.students.update', $student) }}" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email *</label>
        <input type="email" name="email" value="{{ $student->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Class</label>
        <input type="text" name="class" value="{{ $student->class }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Parent</label>
        <select name="parent_id" class="form-select">
            <option value="">Select Parent</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}" {{ $student->parent_id == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Update Student</button>
    <a href="{{ route('teacher.students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
