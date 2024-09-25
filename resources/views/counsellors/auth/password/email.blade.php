@extends('counsellors.dashboard.dashboard')

@section('content')
<div class="container">
    <h1>Reset Password</h1>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('counsellor.password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
</div>
@endsection
