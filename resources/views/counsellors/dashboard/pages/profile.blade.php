@extends('counsellors.dashboard.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Your Profile</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-lg" style="max-width: 900px; margin: 0 auto;">
            <div class="row g-0">
                <!-- Profile Image Section -->
                <div class="col-md-4 text-center p-4 bg-light rounded-start">
                    <img src="{{ $counsellor->profile_image ? asset('storage/' . $counsellor->profile_image) : asset('images/profile-placeholder.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    {{--  <a href="#" class="btn btn-outline-primary btn-sm">Change Picture</a>  --}}
                </div>

                <!-- Profile Details Section -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Profile Details</h5>
                        <div class="row mb-3">
                            <div class="col-6">
                                <p><strong>Full Name:</strong> {{ $counsellor->full_name_with_rate }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Post:</strong> {{ $counsellor->post }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Gender:</strong> {{ ucfirst($counsellor->gender) }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <p><strong>Email:</strong> {{ $counsellor->email }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Phone:</strong> {{ $counsellor->mobile_no }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <p><strong>Username:</strong> {{ $counsellor->username }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>NIC:</strong> {{ $counsellor->NIC }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p><strong>Languages Spoken:</strong>
                                    @if(is_array($counsellor->languages))
                                    @foreach($counsellor->languages as $language)
                                        <span class="badge bg-info text-dark">{{ $language }}</span>
                                    @endforeach
                                @endif
                                </p>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-12">
                                <p><strong>Specializations:</strong>
                                    @if(is_array($counsellor->languages))
                                    @foreach($counsellor->languages as $language)
                                        <span class="badge bg-info text-dark">{{ $language }}</span>
                                    @endforeach
                                @endif
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p><strong>Intro:</strong> {{ $counsellor->intro }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p><strong>Bio:</strong> {{ $counsellor->bio }}</p>
                            </div>
                        </div>

                        <a href="{{ route('counsellor.editDetails') }}" class="btn mt-4" style="background-color: #622864; color:white;">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
