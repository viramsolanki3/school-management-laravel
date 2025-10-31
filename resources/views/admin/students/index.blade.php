@extends('layouts.app')

@section('content')
<h2>All Students</h2>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Class</th>
      <th>Parent</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    @forelse($students as $s)
      <tr>
        <td>{{ $s->name }}</td>
        <td>{{ $s->email ?? '-' }}</td>
        <td>{{ $s->class ?? '-' }}</td>
        <td>{{ $s->parent?->name ?? 'N/A' }}</td>
        <td>{{ $s->created_at->format('d M Y') }}</td>
      </tr>
    @empty
      <tr><td colspan="5" class="text-center">No students found.</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
