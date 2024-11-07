@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<div class="container mt-5">
    <div class="container-timeslot">
        <div class="container-timeslot-details d-flex flex-column flex-md-row align-items-center">
            <div class="counsellor-details-wrapper d-flex align-items-center mb-3 mb-md-0">
                <div class="counsellor-profile-pi me-3">
                    <img
                        src="{{ $counsellor->profile_image
                            ? asset('storage/' . $counsellor->profile_image)
                            : ($counsellor->gender === 'male'
                                ? 'https://static.vecteezy.com/system/resources/previews/000/350/778/non_2x/vector-male-student-icon.jpg'
                                : 'https://static.vecteezy.com/system/resources/previews/000/350/779/non_2x/vector-female-student-icon.jpg')
                        }}"
                        alt="{{ $counsellor->full_name_with_rate }}"
                        class="counsellor-image p-3 rounded img-fluid"
                        style="width: 150px; height: 150px;"
                    >
                </div>
                <div class="person-booking-details">
                    <p class="mb-1">Booking with</p>
                    <h2 class="mb-0">{{ $counsellor->full_name_with_rate }}</h2>
                </div>
            </div>
            <div class="timeslot-details-wrapper text-center text-md-start">
                <div class="icon-booking mb-2">
                    <img src="/images/ok.png" alt="Booking confirmed" style="width: 80px;">
                </div>
                <div class="timeslot-details">
                    <p class="mb-1">{{ date('F j', strtotime($timeslot->date)) }}</p>
                    <p>{{ date('g:i A', strtotime($timeslot->time)) }}</p>
                </div>
            </div>
        </div>
        <nav class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn2">Go back and edit</a>
        </nav>
    </div>

    <div class="booking-form-container mt-4">
        <h2 class="text-center">Let's complete your booking...</h2>
        <div class="booking-form mt-4">
            <form action="{{ route('counsellors.bookings.store', ['counsellor' => $counsellor->counsellor_id, 'timeslot' => $timeslot->timeslot_id ]) }}" method="post" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">Your Name (Optional)</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="mobile-no" class="form-label">Mobile Number (Required)</label>
                    <input type="text" class="form-control @error('mobile-no') is-invalid @enderror" id="mobile-no" name="mobile-no" value="{{ old('mobile-no') }}" placeholder="Enter your mobile number">
                    @error('mobile-no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">Email (Required)</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="faculty" class="form-label">Faculty (Required)</label>
                    <select name="faculty" id="faculty" class="form-control @error('faculty') is-invalid @enderror">
                        <option value="">Select your faculty</option>
                        <option value="graduate_studies" {{ old('faculty') == 'graduate_studies' ? 'selected' : '' }}>Graduate Studies</option>
                        <option value="agricultural_sciences" {{ old('faculty') == 'agricultural_sciences' ? 'selected' : '' }}>Agricultural Sciences</option>
                        <option value="applied_sciences" {{ old('faculty') == 'applied_sciences' ? 'selected' : '' }}>Applied Sciences</option>
                        <option value="geomatics" {{ old('faculty') == 'geomatics' ? 'selected' : '' }}>Geomatics</option>
                        <option value="management_studies" {{ old('faculty') == 'management_studies' ? 'selected' : '' }}>Management Studies</option>
                        <option value="medicine" {{ old('faculty') == 'medicine' ? 'selected' : '' }}>Medicine</option>
                        <option value="social_sciences_and_languages" {{ old('faculty') == 'social_sciences_and_languages' ? 'selected' : '' }}>Social Sciences & Languages</option>
                        <option value="technology" {{ old('faculty') == 'technology' ? 'selected' : '' }}>Technology</option>
                        <option value="computing" {{ old('faculty') == 'computing' ? 'selected' : '' }}>Computing</option>
                    </select>
                    @error('faculty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="registration_no" class="form-label">Registration Number (Optional)</label>
                    <input type="text" class="form-control @error('registration_no') is-invalid @enderror" id="registration_no" name="registration_no" value="{{ old('registration_no') }}" placeholder="Enter your registration number">
                    @error('registration_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="message" class="form-label">Your Message (Optional)</label>
                    <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror" placeholder="Enter any message you want us to hear...">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-3 ">
                    <input type="submit" value="Submit" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    form .btn{
        background-color: #632965;
    }
    .btn2{
        text-decoration: none;
        padding: 5px 5px;
    }
</style>

@endsection

