@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card p-4 shadow-lg border-0 rounded-4" style="width:400px; margin:auto; margin-top:80px;">
    <h3 class="text-center mb-4 fw-bold text-primary">School Management Login</h3>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control rounded-3" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">Login</button>


    </form>
</div>
@endsection
