@extends('counsellors.dashboard.dashboard')

@section('content')
<div class="container">
    <h1>Reset Password</h1>
    <form method="POST" action="{{ route('counsellor.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $email }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
