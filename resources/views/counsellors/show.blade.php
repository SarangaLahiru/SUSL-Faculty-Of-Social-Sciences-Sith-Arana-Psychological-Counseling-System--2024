@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
<div class="container mt-5">
    <div class="row">
        <!-- Counsellor Details -->
        <div class="col-12 col-sm-8">
            <div class="row mb-4">
                <!-- Profile Picture -->
                <div class="col-sm-3">
                    <div class="profile-pic">
                        <img class="p-3 rounded img-fluid" src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Counsellor Profile Picture" style="width: 250px; height: 250px;">
                    </div>
                </div>
                <!-- Contact Details -->
                <div class="col-sm-9">
                    <div class="contact-details">
                        <div class="name-and-position-wrapper mb-3">
                            <h1>{{ $counsellor->full_name_with_rate }}</h1>
                            <h2>Professor of Faculty of Social Sciences</h2>
                        </div>
                        <hr class="border-dark border-top mb-3">
                        <div class="tel-wrapper d-flex align-items-center mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <p class="mb-0">{{ $counsellor->mobile_no }}</p>
                        </div>
                        <div class="email-wrapper d-flex align-items-center">
                            <i class="fas fa-envelope me-2"></i>
                            <p class="mb-0">{{ $counsellor->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="bio-wrapper mt-4">
                    <p>{{ $counsellor->bio }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 languages">
                    <h2>Languages Spoken</h2>
                    <ul>
                        <li>English (Fluent)</li>
                        <li>Sinhala (Native)</li>
                    </ul>
                </div>
                <div class="col-4 specialisation">
                    <h2>Specialisations</h2>
                    <ul>
                        <li>Stress management</li>
                        <li>Relationship dynamics</li>
                        <li>Academic and career guidance</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 reviews">
                    <h2>Verified Reviews</h2>
                    <div class="d-flex align-items-center review-box">
                        <!-- Previous Arrow -->
                        <button class="btn">
                            <img src="/images/left-arrow.svg" alt="">
                        </button>

                        <!-- Review Content -->
                        <div class="flex-grow-1 px-3">
                            <p>
                                This platform has been a game-changer for me! I used to struggle with finding the time and courage to seek counselling, but now, with just a few clicks, I can book an appointment that fits my schedule. The counsellors are supportive and understanding, and I've seen a significant improvement in my mental well-being since using the platform.
                            </p>
                        </div>

                        <!-- Next Arrow -->
                        <button class="btn">
                            <img src="/images/right-arrow.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 reviews">
                    <h2>Add Your Review</h2>
                    <div class="d-flex align-items-center review-box">
                        <form action="#" class="review-form w-100">
                            <div class="mb-3">
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Type your message.."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-gradient">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Timeslots -->
       <div class="col-12 col-sm-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Booking {{ $counsellor->full_name }}
        </div>
        <div class="card-body">
            <div class="card-text">
                <div class="row mb-3">
                    <div class="col">
                        <h2>Date</h2>
                        <h3>May / 15</h3>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <a href="#" class="btn btn-primary">Set Date</a>
                    </div>
                </div>
                <div class="booking-timeslots-container">
                    @foreach ($timeslots->chunk(2) as $timeslotChunk)
                        <div class="row mb-2">
                            @foreach ($timeslotChunk as $timeslot)
                                <div class="col-6">
                                    <a href="{{ route('counsellors.bookings.create', ['counsellor' => $counsellor->counsellor_id, 'timeslot_id' => $timeslot->timeslot_id]) }}">

                                            {{ date('h:i A', strtotime($timeslot->time)) }}

                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <a href="#" class="btn btn-primary w-100 mt-3">Next</a>
            </div>
        </div>
    </div>
</div>

</div>
    </div>
</div>
@endsection
