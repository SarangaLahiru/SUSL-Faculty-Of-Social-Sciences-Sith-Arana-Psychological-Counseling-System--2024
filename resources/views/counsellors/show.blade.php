@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')




<div class="container mt-5">
    <div class="row">
        <!-- Counsellor Details -->
        <div class="col-12 col-sm-8">
            <div class="row mb-4">
                <!-- Profile Picture -->
                <div class="col-sm-3">
                    <div class="profile-pic">
                        <img class="p-3 rounded img-fluid"
                             src="{{ $counsellor->profile_image ? asset('storage/' . $counsellor->profile_image) : ($counsellor->gender === 'male' ? 'https://t4.ftcdn.net/jpg/02/44/43/69/360_F_244436923_vkMe10KKKiw5bjhZeRDT05moxWcPpdmb.jpg':'https://static.vecteezy.com/system/resources/previews/000/350/779/non_2x/vector-female-student-icon.jpg') }}"
                             alt="{{ $counsellor->full_name_with_rate }}" style="width: 250px; height: 250px;">
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

                            <i class="bi bi-telephone me-2"></i>
                            <p class="mb-0">{{ $counsellor->mobile_no }}</p>
                        </div>
                        <div class="email-wrapper d-flex align-items-center">

                            <i class="bi bi-envelope me-2"></i>
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
                    <h2>Languages Spoke</h2>
                    <ul>
                        @if($counsellor->languages && count($counsellor->languages) > 0)
                            @foreach ($counsellor->languages as $language)
                                <li>{{ $language }}</li>
                            @endforeach
                        @else
                            <li>No languages specified.</li>
                        @endif
                    </ul>
                </div>
                <div class="col-4 languages">
                    <h2>Specialisation</h2>

                <ul>
                    @if($counsellor->specializations && count($counsellor->specializations) > 0)
                    @foreach ($counsellor->specializations as $specialization)
                        <li>{{ $specialization }}</li>

                    @endforeach
                @else
                    <li>No languages specified.</li>
                @endif
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
                        <button class="btn1">
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
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    Booking {{ $counsellor->full_name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <div class="row mb-3">
                            <div class="col">
                                <h2>Date</h2>
                                <h3>{{ \Carbon\Carbon::parse($selectedDate)->format('F / d') }}</h3>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dateModal">Set Date</a>
                            </div>

                            <!-- Booking Timeslots -->
                            <div class="booking-timeslots-container">
                                @if($timeslots->isEmpty())
                                    <p>No available timeslots for this date.</p>
                                @else
                                    @foreach ($timeslots->chunk(2) as $timeslotChunk)
                                        <div class="row mb-2">
                                            @foreach ($timeslotChunk as $timeslot)
                                                <div class="col-6">
                                                    <a href="#"
                                                       class="timeslot {{ session('selected_timeslot') == $timeslot->timeslot_id ? 'highlight' : '' }}"
                                                       data-timeslot-id="{{ $timeslot->timeslot_id }}"
                                                       onclick="selectTimeslot(this)">
                                                        {{ date('h:i A', strtotime($timeslot->time)) }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="#" id="nextButton" class="btn btn-primary w-100 mt-3" onclick="goToNextPage()">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date Selection Modal -->
        <!-- Date Selection Modal -->
<!-- Creative Date Selection Modal with Animated Tiles -->
<div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title d-flex align-items-center" id="dateModalLabel">
                     Select a Date
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('counsellors.show', $counsellor->counsellor_id) }}" method="GET">
                    <!-- Creative Date Tiles -->
                    <div class="form-group">
                        <label for="date" class="form-label mb-3">Available Dates</label>
                        <div class="d-flex flex-wrap gap-3 justify-content-center"> <!-- Flexbox for tiles -->
                            @foreach($availableDates as $date)
                                <label class="date-tile" for="date-{{ $date }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to select {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}">
                                    <input type="radio" name="date" id="date-{{ $date }}" value="{{ $date }}" class="d-none" {{ $date == $selectedDate ? 'checked' : '' }}>
                                    <div class="date-content text-center py-4 px-3 rounded">

                                        <div class="mt-2">
                                            <span class="date-day">{{ \Carbon\Carbon::parse($date)->format('d') }}</span> <br>
                                            <span class="date-month">{{ \Carbon\Carbon::parse($date)->format('F') }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="counsellor_id" value="{{ $counsellor->counsellor_id }}">
            </div>
            <div class="modal-footer justify-content-between w-100">

                <button type="submit" class="btn  w-100 align-items-center shadow-sm">
                    Select Date
                </button>
            </div>
                </form>
        </div>
    </div>
</div>

        </div>



        <script>
            let selectedTimeslotId = null;

            function selectTimeslot(element) {
                console.log("Timeslot clicked!");

                const timeslots = document.querySelectorAll('.timeslot');
                timeslots.forEach((slot) => {
                    slot.classList.remove('highlight');
                });

                element.classList.add('highlight');
                selectedTimeslotId = element.getAttribute('data-timeslot-id');
                console.log("Selected Timeslot ID: ", selectedTimeslotId);
            }

            function goToNextPage() {
                if (selectedTimeslotId) {
                    window.location.href = `{{ route('counsellors.bookings.create', ['counsellor' => $counsellor->counsellor_id]) }}?timeslot_id=${selectedTimeslotId}`;
                } else {
                    alert('Please select a timeslot before proceeding.');
                }
            }
        </script>

    </div>
</div>

<!-- Bootstrap JS (Ensure you have Bootstrap CSS included in your app layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
