@extends('counsellors.dashboard.dashboard')

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
            <p><strong>Name:</strong> {{ $counsellor->full_name_with_rate }}</p>
            <p><strong>Email:</strong> {{ $counsellor->email }}</p>
            <p><strong>Phone:</strong> {{ $counsellor->mobile_no }}</p>
            {{-- Uncomment this section if you want to include a position field --}}
            {{-- <p><strong>Position:</strong> {{ $counsellor->position }}</p> --}}

            <a href="{{ route('counsellor.editDetails') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
@endsection
