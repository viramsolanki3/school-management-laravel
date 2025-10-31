@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<div class="card p-4 shadow-lg border-0 rounded-4" style="width:450px; margin:auto; margin-top:80px;">
    <h3 class="text-center mb-4 fw-bold text-primary">Create an Account</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control rounded-3" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control rounded-3" required>
        </div>

        <button type="submit" class="btn btn-success w-100 py-2 rounded-3 fw-semibold">Register</button>

        <div class="text-center mt-3">
            <small>Already have an account? <a href="{{ route('login') }}" class="text-primary fw-semibold">Login</a></small>
        </div>
    </form>
</div>
@endsection
