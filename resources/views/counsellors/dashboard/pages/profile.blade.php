<!-- resources/views/profile.blade.php -->

@extends('counsellors.dashboard.dashboard')

@section('content')
    <h1>Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mr. John Doe</h5>
            <p>Email: johndoe@example.com</p>
            <p>Phone: +94 75 6667 890</p>
            <p>Position: Professor</p>
            <a href="#" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
@endsection
