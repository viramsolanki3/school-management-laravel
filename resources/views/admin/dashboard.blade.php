@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
          <h4 class="fw-bold text-primary">{{ \App\Models\Teacher::count() }}</h4>
          <p class="text-muted">Total Teachers</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
          <h4 class="fw-bold text-success">{{ \App\Models\Student::count() }}</h4>
          <p class="text-muted">Total Students</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
          <h4 class="fw-bold text-info">{{ \App\Models\ParentModel::count() }}</h4>
          <p class="text-muted">Total Parents</p>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold">📢 Teacher Announcements</div>
    <div class="card-body">
      @forelse($announcements as $a)
        <div class="border-bottom pb-2 mb-3">
          <h6 class="fw-semibold">{{ $a->title }}</h6>
          <p class="text-muted small mb-1">{{ $a->content }}</p>
          <small class="text-secondary">By: {{ ucfirst($a->author_role) }} | {{ $a->created_at->format('d M Y') }}</small>
        </div>
      @empty
        <p class="text-muted">No announcements yet.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection
