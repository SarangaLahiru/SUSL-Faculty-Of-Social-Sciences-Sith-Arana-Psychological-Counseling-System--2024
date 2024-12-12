@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')




<div class="container mt-5 " style="padding: 100px 0px;">
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
                <div class="col-sm-5">
                    <div class="contact-details">
                        <div class="name-and-position-wrapper mb-3">
                            <h1>{{ $counsellor->full_name_with_rate }}</h1>
                            <h2>{{ $counsellor->post }}</h2>
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
                <div class="col-4  languages">
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
                <div class="col-4  languages">
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

{{--

            <div class="row mt-4">
                <div class="col-sm-12 reviews">
                    <h2>Verified Reviews</h2>
                    <div class="d-flex align-items-center review-box">
                        <!-- Previous Arrow -->
                        <button class="btn1">
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
            </div>  --}}
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
                                            @foreach ($timeslots as $timeslot)
    <div class="col-6" >
        <a href="#" style="font-size: 17px; padding:10px 2px;"
           class="timeslot {{ session('selected_timeslot') == $timeslot->timeslot_id ? 'highlight' : '' }}"
           data-timeslot-id="{{ $timeslot->timeslot_id }}"
           onclick="selectTimeslot(this)">
           {{ date('h:i A', strtotime($timeslot->time)) }} -
           {{ date('h:i A', strtotime($timeslot->time . ' + ' . $timeslot->duration . ' minutes')) }}
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
<div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title d-flex align-items-center" id="dateModalLabel">Select a Date</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('counsellors.show', $counsellor->counsellor_id) }}" method="GET">
                    <div class="form-group">
                        <label for="date" class="form-label mb-3">Available Dates</label>

                        <!-- Month Navigation with Styled Buttons -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" id="prevMonth" class="btn btn-nav">&larr;</button>
                            <h5 class="text-center month-display" id="monthYearDisplay"></h5>
                            <button type="button" id="nextMonth" class="btn btn-nav">&rarr;</button>
                        </div>

                        <!-- Calendar Grid for Available Dates -->
                        <div class="calendar-grid d-flex flex-wrap gap-3 justify-content-center"></div>
                    </div>
                    <input type="hidden" name="counsellor_id" value="{{ $counsellor->counsellor_id }}">
                    <input type="hidden" name="date" id="selectedDateInput">

                    <div class="modal-footer justify-content-between w-100">
                        <button type="submit" class="btn btn-gradient-primary w-100 shadow-sm">Select Date</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--  <div id="timeslotModal" class="modal" style="display: none;">
    <div class="modal-content" style="text-align: center; padding: 20px; border: 1px solid #ddd;">
        <span class="close" onclick="closeModal()" style="cursor: pointer; float: right;">&times;</span>
        <h3>Timeslot Selection</h3>
        <img src="path-to-your-image.jpg" alt="Select Timeslot" style="width: 100px; height: 100px; margin: 10px 0;">
        <p>Please select a timeslot before proceeding.</p>
        <button onclick="closeModal()">OK</button>
    </div>
</div>  --}}

<!-- Bootstrap Modal -->
<div class="modal fade" id="timeslotModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <!-- Alert Section -->
            <div id="alertSection" class="alert alert-warning text-center" style="margin: 0; border-radius: 0; display: none;">
                <p style="font-size: 15px;"><strong>⚠️ Warning!</strong> Please select a timeslot before proceeding.</p>
            </div>
            <!-- Modal Header -->
            {{--  <div class="modal-header text-center" style="background-color: #941b9a; color: white; display: flex; justify-content: center;">

                <h5 class="modal-title w-100" id="thankYouModalLabel" style="font-weight: bold; font-size: 2em;">🎉 Thank You!</h5>
            </div>  --}}
            <!-- Modal Body -->
            <div class="modal-body text-center" style="padding: 12px; font-size: 1.5em; color: #444;">
                <!-- Image -->
                <img  src="{{ asset('images/sitharana2.gif') }}"   alt="Thank You" style="width: 450px; height: auto; margin-bottom: 20px; border-radius: 10px;">
                <!-- Text -->
                {{--  <p style="margin: 0; font-weight: 500;">
                    Thank you for your feedback!<br>We appreciate your input and support.
                </p>  --}}
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center" style="border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn btn-primary px-4 py-2" id="close1" onclick="closeModal()" style="background-color: #8d1b9a; border-color: #6a1b9a;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- CSS for Enhanced Styling -->
<style>



    /* Main Modal Enhancements */




    /* Month Navigation Buttons */
    .btn-nav {

        color: #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        border: none;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        transition: background-color 0.3s ease, transform 0.2s ease;
    }


    /* Calendar Styling */
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }
    .date-tile {
        position: relative;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .date-content {

        border-radius: 12px;
        padding: 25px 10px;
        font-size: 2rem;
        color: #333;
        text-align: center;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
    }
    .date-content:hover {
        background: #e6f0ff;
        box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.2);
    }
    .date-content.active {

        color: #fff;
        font-weight: bold;
    }

    /* Month Display Style */
    .month-display {
        font-size: 1.2rem;
        color: #374151;
        font-weight: 600;
    }
</style>



<!-- JavaScript for Month Navigation and Date Selection -->

<!-- JavaScript for Month Navigation and Date Selection -->
<!-- JavaScript for Month Navigation and Date Selection with Weekday Display -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const availableDates = @json($availableDates);
    const groupedDates = availableDates.reduce((acc, date) => {
        const monthYear = new Date(date).toLocaleString('default', { month: 'long', year: 'numeric' });
        acc[monthYear] = acc[monthYear] || [];
        acc[monthYear].push(date);
        return acc;
    }, {});

    let currentMonthIndex = 0;
    const monthYearKeys = Object.keys(groupedDates);
    const monthYearDisplay = document.getElementById('monthYearDisplay');
    const calendarGrid = document.querySelector('.calendar-grid');
    const selectedDateInput = document.getElementById('selectedDateInput');

    function renderCalendar(monthYear) {
        monthYearDisplay.textContent = monthYear;
        calendarGrid.innerHTML = '';

        groupedDates[monthYear].forEach(date => {
            const dateObj = new Date(date);
            const day = dateObj.getDate();
            const weekday = dateObj.toLocaleString('default', { weekday: 'short' }); // Get short weekday name (e.g., "Mon")

            const label = document.createElement('label');
            label.className = 'date-tile';

            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'date';
            input.value = date;
            input.classList.add('d-none');

            const dateContent = document.createElement('div');
            dateContent.className = 'date-content text-center';
            dateContent.innerHTML = `<span class="weekday">${weekday}</span><br><strong>${day}</strong>`;
            dateContent.onclick = function() {
                document.querySelectorAll('.date-content').forEach(d => d.classList.remove('active'));
                dateContent.classList.add('active');
                input.checked = true;
                selectedDateInput.value = date; // Set selected date
            };

            label.append(input, dateContent);
            calendarGrid.append(label);
        });
    }

    // Initial render for the first month
    renderCalendar(monthYearKeys[currentMonthIndex]);

    // Month navigation event listeners
    document.getElementById('prevMonth').addEventListener('click', () => {
        if (currentMonthIndex > 0) {
            currentMonthIndex--;
            renderCalendar(monthYearKeys[currentMonthIndex]);
        }
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        if (currentMonthIndex < monthYearKeys.length - 1) {
            currentMonthIndex++;
            renderCalendar(monthYearKeys[currentMonthIndex]);
        }
    });
});
</script>

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

    {{--  function goToNextPage() {
        if (selectedTimeslotId) {
            window.location.href = `{{ route('counsellors.bookings.create', ['counsellor' => $counsellor->counsellor_id]) }}?timeslot_id=${selectedTimeslotId}`;
        } else {
            alert('Please select a timeslot before proceeding.');
        }
    }  --}}


function goToNextPage() {
if (selectedTimeslotId) {
    // Redirect to the next page
    window.location.href = `{{ route('counsellors.bookings.create', ['counsellor' => $counsellor->counsellor_id]) }}?timeslot_id=${selectedTimeslotId}`;
} else {
    // Show the alert and the modal
    document.getElementById('alertSection').style.display = 'block';
    const modal = new bootstrap.Modal(document.getElementById('timeslotModal'));
    modal.show();
}
}

function closeModal() {
// Hide the modal and the alert
const modal = bootstrap.Modal.getInstance(document.getElementById('timeslotModal'));
modal.hide();
document.getElementById('alertSection').style.display = 'none';
}
</script>

<!-- Bootstrap JS (Ensure you have Bootstrap CSS included in your app layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
