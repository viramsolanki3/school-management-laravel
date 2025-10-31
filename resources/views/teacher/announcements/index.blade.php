@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>My Announcements</h2>
    <a href="{{ route('teacher.announcements.create') }}" class="btn btn-primary">+ New Announcement</a>
</div>


<table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Target</th>
      <th>Message</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($announcements as $a)
    <tr>
      <td>{{ $a->title }}</td>
      <td>
        @if($a->to_students && $a->to_parents) All
        @elseif($a->to_students) Students
        @elseif($a->to_parents) Parents
        @endif
      </td>
      <td>{{ Str::limit($a->body, 50) }}</td>
      <td>{{ $a->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
