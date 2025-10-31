@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<div class="card p-4 shadow-lg border-0 rounded-4" style="width:400px; margin:auto; margin-top:80px;">
    <h3 class="text-center mb-4 fw-bold text-primary">Forgot Password</h3>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control rounded-3" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
            Send Password Reset Link
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-primary fw-semibold">Back to Login</a>
        </div>
    </form>
</div>
@endsection
