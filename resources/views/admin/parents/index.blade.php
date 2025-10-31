@extends('layouts.app')

@section('content')
<h2>All Parents</h2>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    @forelse($parents as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->email ?? '-' }}</td>
        <td>{{ $p->phone ?? '-' }}</td>
        <td>{{ $p->created_at->format('d M Y') }}</td>
      </tr>
    @empty
      <tr><td colspan="4" class="text-center">No parents found.</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
