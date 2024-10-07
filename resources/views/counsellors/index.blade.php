@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        font-size: 12px;
    }

    #top,
    #calendar.fc-unthemed {
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    }

    /* Custom styles for the "today" date */
    .fc-today {
        background-color: #ffeb3b; /* Highlight color */
        color: #000; /* Text color */
        font-weight: bold; /* Bold text */
        border: 2px solid #ffc107; /* Border color */
    }

    /* Button styles */
    .fc-prev-button,
    .fc-next-button {
        background-color: white;
        color: black; /* Text color */
        border: none; /* Remove border */
        border-radius: 5px; /* Rounded corners */
        padding: 5px 10px; /* Padding */
        cursor: pointer; /* Pointer cursor on hover */
    }

    #top {
        background: #eee;
        border-bottom: 1px solid #ddd;
        padding: 0 10px;
        line-height: 40px;
        font-size: 12px;
        color: #000;
    }

    .filters {
        padding: 20px 0;
    }

    #calendar {
        max-width: 900px;
        margin: 40px auto;
        padding: 10px 10px;
    }

    /* Change header background color */
    .fc-toolbar {
        background-color: #632965; /* Change to your desired color */
        color: white; /* Change text color */
        padding: 10px 15px;
    }

    /* Change the day cell background color */
    .fc-day {
        background-color: #f8f9fc; /* Change to your desired color */
    }

    /* Change the weekend day cell background color */
    .fc-day-sat,
    .fc-day-sun {
        background-color: #ffe5e5; /* Change to your desired color */
    }

    /* Change the event background color */
    .fc-event {
        background-color: #1cc88a; /* Change to your desired color */
        border-color: #17a673; /* Change border color */
        color: white; /* Change text color of events */
    }
</style>

<div>
    <div class="showcase text-center mt-5">
        <h1>Book a session</h1>
        <p>Book a session with our qualified Counsellors</p>
    </div>

    <div class="box mt-5">
        <div class="row">
            {{-- Filters section --}}
            <div class="col-sm-12 col-lg-5 mb-4 col-md-12 p-5 filters">
                <div class="shadow-lg">
                    <div id='calendar'></div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{-- Days filter --}}
                        <div class="filters-body">
                            {{-- Gender filter --}}
                            <div class="gender-filter">
                                <h3>Gender</h3>
                                <ul class="list-unstyled d-flex">
                                    @php
                                        $query = request()->query(); // Capture existing query parameters
                                    @endphp
                                    <li class="m-2">
                                        @php $query['gender'] = 'male'; @endphp
                                        <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'male' ? 'active' : '' }}">Male</a>
                                    </li>
                                    <li class="m-2">
                                        @php $query['gender'] = 'female'; @endphp
                                        <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'female' ? 'active' : '' }}">Female</a>
                                    </li>
                                    <li class="m-2">
                                        @php unset($query['gender']); @endphp
                                        <a href="{{ route('counsellors.index', $query) }}" class="{{ !request('gender') ? 'active' : '' }}">Any</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Counsellors list --}}
            <div class="col-sm-12 col-lg-7 col-md-12 mb-4">
                <div class="justify-content-center p-3 p-lg-5">
                    @foreach ($counsellors as $counsellor)
                        <div class="col-12 col-md-12 mb-4 shadow rounded-2">
                            <div class="card counsellor-card">
                                <div class="row no-gutters">
                                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                        <img
                                            src="{{ $counsellor->profile_image
                                                ? asset('storage/' . $counsellor->profile_image)
                                                : ($counsellor->gender === 'male'
                                                    ? 'https://t4.ftcdn.net/jpg/02/44/43/69/360_F_244436923_vkMe10KKKiw5bjhZeRDT05moxWcPpdmb.jpg'
                                                    : 'https://static.vecteezy.com/system/resources/previews/000/350/779/non_2x/vector-female-student-icon.jpg') }}"
                                            class="counsellor-image p-3 p-md-4 rounded img-fluid"
                                        >
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-size: 28px">{{ $counsellor->full_name_with_rate }}</h5>
                                            <p class="card-subtitle mb-2 text-muted" style="font-size: 16px">{{ $counsellor->title }}</p>
                                            <hr>
                                            <p class="card-text">{{ $counsellor->intro }}</p>
                                            <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id]) }}" class="see-more-link">See more about {{ $counsellor->full_name_with_rate }} ></a>

                                            <div class="row mt-4 mt-md-5">
                                                <div class="col-7">
                                                    <p class="mb-2 text-muted" style="font-size: 14px;"><strong>Next available</strong></p>
                                                    {{-- Show the next available time slot --}}
                                                    @if ($counsellor->nextAvailableSlot)
                                                        <p class="text-primary mb-3" style="font-size: 14px;">
                                                            {{ $counsellor->nextAvailableSlot['date'] }} at {{ $counsellor->nextAvailableSlot['time'] }}
                                                        </p>
                                                    @else
                                                        <p class="text-danger mb-3" style="font-size: 14px;">No available slots</p>
                                                    @endif
                                                </div>
                                                <div class="col col-lg-5 mt-2">
                                                    @if ($counsellor->nextAvailableSlot)
                                                        <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id, 'date' => \Carbon\Carbon::parse($counsellor->nextAvailableSlot['date'])->format('Y-m-d'), 'counsellor_id' => $counsellor->counsellor_id]) }}"
                                                           class="btn-gradient-primary" {{ !$counsellor->nextAvailableSlot ? 'disabled' : '' }}>
                                                            Book Now
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination links --}}
                    <div class="d-flex justify-content-center mt-5">
                        {{ $counsellors->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .highlighted-date {
     background-color: #632965 !important; /* Yellow background */
     border-color: #632965 !important;      /* Border for the highlighted cell */
 }
 .highlighted-date .fc-day-number {
    color: white !important;  /* Red date number */
    font-weight: bold;          /* Make the number bold */
}
.fc-day-number{
    color: #632965;
    font-size: 16px
}
 </style>

{{-- Scripts --}}
<script src='packages/core/main.js'></script>
<script src='packages/interaction/main.js'></script>
<script src='packages/bootstrap/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/timegrid/main.js'></script>
<script src='packages/list/main.js'></script>
<script src='js/theme-chooser.js'></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>


    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');

        // Extract the selected date from the query string (if available)
        var selectedDate = new URLSearchParams(window.location.search).get('date');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
            themeSystem: 'bootstrap 4',
            events: @json($calendarEvents),  // Event data from your backend

            header: {
                left: 'title',
                center: 'prev,next today',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            weekNumbers: true,
            navLinks: true,
            eventLimit: true,

            // Handle clicking on a date cell
            dateClick: function(info) {
                var clickedDate = info.dateStr;  // Get the clicked date in 'YYYY-MM-DD' format

                // Redirect to the same page with the clicked date as a query parameter
                window.location.href = '?date=' + clickedDate;
            },

            // After each calendar render, highlight the selected date (if any)
            datesSet: function() {
                highlightSelectedDate();
            },

            // Handle event clicks (if needed)
            eventClick: function(info) {
                info.jsEvent.preventDefault();  // Prevent default behavior

                // Redirect with the event start date as the query parameter
                var eventStart = info.event.start.toISOString().split('T')[0]; // 'YYYY-MM-DD' format
                window.location.href = '?date=' + eventStart;
            }
        });

        calendar.render();  // Render the calendar

        // Function to highlight the selected date after render
        function highlightSelectedDate() {
            // Remove previous highlights first
            $('.fc-day').removeClass('highlighted-date');

            if (selectedDate) {
                // Highlight the date cell using data-date attribute
                var dateCell = $('[data-date="' + selectedDate + '"]');
                if (dateCell.length) {
                    dateCell.addClass('highlighted-date');
                }
            }
        }

        // Call highlight function on page load for selected date
        highlightSelectedDate();
    });

</script>






@endsection
