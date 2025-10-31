@extends('layouts.app')

@section('content')
<h2>Add New Parent</h2>

<form method="POST" action="{{ route('teacher.parents.store') }}" class="mt-3">
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
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" maxlength="12" pattern="[0-9]*" inputmode="numeric">
    </div>

    <button class="btn btn-success">Add Parent</button>
    <a href="{{ route('teacher.parents.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
