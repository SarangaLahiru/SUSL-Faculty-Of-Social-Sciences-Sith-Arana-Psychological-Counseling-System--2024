@extends('admin.dashboard')

@section('content')
    <h1>Edit Profile</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Profile Details</h5>

    </div>
@endsection
