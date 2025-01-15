@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<!-- Styles for Buttons and Form Toggle -->
<style>
    .toggle-buttons .toggle-btn {
        font-size: 1.8rem;
        width: 200px;
        transition: all 0.3s ease-in-out;
        border-width: 2px;
        margin: 0 10px;
    }

    .toggle-buttons .toggle-btn.active {
        background-color:#632965;
        color: #fff;
    }

    .toggle-buttons .toggle-btn:not(.active) {
        background-color: #f8f9fa;
        color: #353637;
    }

    .toggle-buttons .toggle-btn:not(.active):hover {
        background-color: #e2e6ea;
        color: #495057;
    }

    form .btn {
        background-color: #632965;
    }

    .btn2 {
        text-decoration: none;
        padding: 5px 10px;
    }
</style>

<!-- Content Container -->
<div class="container mt-5">
    <!-- Counsellor Details -->
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
                    <p>
                        {{ date('g:i A', strtotime($timeslot->time)) }} -
                        {{ date('g:i A', strtotime($timeslot->time . ' + ' . $timeslot->duration . ' minutes')) }}
                    </p>
                </div>
            </div>
        </div>
        <nav class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn2">Go back and edit</a>
        </nav>
    </div>

    <!-- Data Privacy Notice -->
    <div class="alert alert-info mt-4">
        <strong>Data Privacy:</strong> Your information is securely stored and will only be used for the purposes of your counselling session. We value your privacy.
    </div>

    <!-- Form Toggle Buttons -->
    <div class="text-center my-4 toggle-buttons">
        <button class="btn btn-outline-primary p-3 toggle-btn active" id="showStudentForm" onclick="showForm('student')">
             Student
        </button>
        <button class="btn btn-outline-secondary p-3 toggle-btn" id="showOtherForm" onclick="showForm('other')">
             Other
        </button>
    </div>

    <!-- Student Booking Form -->
    <div id="studentForm" class="booking-form mt-4">
        <form action="{{ route('counsellors.bookings.store', ['counsellor' => $counsellor->counsellor_id, 'timeslot' => $timeslot->timeslot_id ]) }}" method="post" class="row g-3">
            @csrf

            <input type="hidden" name="category" value="student">

            <div class="col-md-12">
                <label for="name" class="form-label">Your Name (Required)</label>
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
                <label for="gender" class="form-label">Gender (Required)</label>
                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Select your gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                   </select>
                @error('gender')
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
                <label for="registration_no" class="form-label">Registration Number (Required)</label>
                <input type="text" class="form-control @error('registration_no') is-invalid @enderror" id="registration_no" name="registration_no" value="{{ old('registration_no') }}" placeholder="Enter your registration number">
                @error('registration_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="year" class="form-label">Year (Required)</label>
                <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                    <option value="" disabled selected>Select your year</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>
                @error('year')
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

    <!-- Other Booking Form -->
    <div id="otherForm" class="booking-form mt-4" style="display: none;">
        <form action="{{ route('counsellors.bookings.store', ['counsellor' => $counsellor->counsellor_id, 'timeslot' => $timeslot->timeslot_id ]) }}" method="post" class="row g-3">
            @csrf

            <input type="hidden" name="category" value="other">

            <div class="col-md-12">
                <label for="name" class="form-label">Your Name (Required)</label>
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
                <label for="NIC" class="form-label">NIC (Required)</label>
                <input type="NIC" class="form-control @error('NIC') is-invalid @enderror" id="NIC" name="NIC" value="{{ old('NIC') }}" placeholder="Enter your NIC">
                @error('NIC')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="gender" class="form-label">Gender (Required)</label>
                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Select your gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{--  <div class="col-md-12">
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
            </div>  --}}

            {{--  <div class="col-md-12">
                <label for="registration_no" class="form-label">Registration Number (Required)</label>
                <input type="text" class="form-control @error('registration_no') is-invalid @enderror" id="registration_no" name="registration_no" value="{{ old('registration_no') }}" placeholder="Enter your registration number">
                @error('registration_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>  --}}

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

<!-- JavaScript -->
<script>
    function showForm(type) {
        const studentForm = document.getElementById('studentForm');
        const otherForm = document.getElementById('otherForm');
        const studentButton = document.getElementById('showStudentForm');
        const otherButton = document.getElementById('showOtherForm');

        if (type === 'student') {
            studentForm.style.display = 'block';
            otherForm.style.display = 'none';
            studentButton.classList.add('active');
            otherButton.classList.remove('active');
        } else {
            studentForm.style.display = 'none';
            otherForm.style.display = 'block';
            otherButton.classList.add('active');
            studentButton.classList.remove('active');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        showForm('student');
    });
</script>

@endsection
