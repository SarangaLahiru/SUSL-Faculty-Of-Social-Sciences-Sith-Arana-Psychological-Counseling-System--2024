@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<div class="container mt-5">
    <div class="container-timeslot">
        <div class="container-timeslot-details">
            <div class="counsellor-details-wrapper">
                <div class="cousellor-profile-pic"></div>
                <div class="person-booking-details">
                    <p>Booking with</p>
                    <h2>{{ $counsellor->full_name_with_rate}}</h2>
                </div>
            </div>
            <div class="timeslot-details-wrapper">
                <div class="icon-booking">
                    <img src="/images/ok.png" alt="">
                </div>
                <div class="timeslot-details">
                    <p>{{ date('F j', strtotime($timeslot->date)) }}</p>
                    <p>{{ date('g:i A', strtotime($timeslot->time)) }}</p>
                </div>
            </div>

        </div>
        <nav>
            <a href="{{ url()->previous() }}">Go back and edit</a>
        </nav>
    </div>



    <div class="booking-form-container">
        <h2>Let's complete your booking...</h2>
        <div class="booking-form">
            <form action="{{ route('counsellors.bookings.store', ['counsellor' => $counsellor->counsellor_id, 'timeslot' => $timeslot->timeslot_id ]) }}" method="post">
                @csrf
                <div>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name (optional)">
                </div>
                <div>
                    <input type="text" class="form-control" name="mobile-no" id="mobile-no" placeholder="Enter your mobile number (This field is required)">
                </div>
                <div>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email (This field is required)">
                </div>
                <div>
                    <select name="faculty" id="faculty" class="form-control">
                        <option value="graduate_studies">Graduate Studies</option>
                        <option value="agricultural_sciences">Agricultural Sciences</option>
                        <option value="applied_sciences">Applied Sciences</option>
                        <option value="geomatics">Geomatics</option>
                        <option value="management_studies">Management Studies</option>
                        <option value="medicine">Medicine</option>
                        <option value="social_sciences_and_languages">Social Sciences & Languages</option>
                        <option value="technology">Technology</option>
                        <option value="computing">Computing</option>
                    </select>
                </div>
                <div>
                    <input type="text" class="form-control" id="registration_no" placeholder="Enter your registration number (optional)">
                </div>
                <div>
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control" placeholder="Enter any message you want us to hear..."></textarea>
                </div>
                <div class="text-right">
                    <input type="submit" value="Submit" id="submit" class="btn-gradiant">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
