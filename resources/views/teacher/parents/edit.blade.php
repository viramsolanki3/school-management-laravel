@extends('layouts.app')

@section('content')
<h2>Edit Parent</h2>

<form method="POST" action="{{ route('teacher.parents.update', $parent) }}" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name *</label>
        <input type="text" name="name" value="{{ $parent->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email *</label>
        <input type="email" name="email" value="{{ $parent->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" value="{{ $parent->phone }}" class="form-control" maxlength="12" pattern="[0-9]*" inputmode="numeric">
    </div>

    <button class="btn btn-primary">Update Parent</button>
    <a href="{{ route('teacher.parents.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
