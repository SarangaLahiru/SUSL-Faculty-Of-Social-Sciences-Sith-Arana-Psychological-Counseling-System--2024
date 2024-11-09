@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')

<style>
    /* Body and general styling */
    body {
        margin: 0;
        padding: 0;
        font-size: 14px;
        font-family: Arial, sans-serif;

        color: #333;
    }

    /* Main container for the two-column layout */
    .container-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px;
    }

    /* Calendar container */
    .calendar-container {
        flex: 1;
        max-width: 480px;
        max-height: auto;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        background-color: #ffffff47;
        text-align: center;
        margin-bottom: 20px;

    }

    /* Calendar header */
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.5rem;
        color: #fff;
        background-color: #632965;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }

    .calendar-header i {
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .calendar-header i:hover {
        color: #ffeb3b;
    }

    /* Calendar days (weekdays) and dates */
    .calendar-days, .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        padding: 15px;
        background-color: #ffffff90;
        border-radius: 0 0 10px 10px;
    }
    .title{
        font-size: 20px;
        width: 400px;
        text-align: center;
        padding: 10px 0px;
    }

    /* Day names */
    .day {
        font-weight: bold;
        color: #666;
    }

    /* General date styling */
    .date {
        padding: 10px;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.2s;
    }

    /* Faded style for previous and next month's dates */
    .date.previous-month, .date.next-month {
        color: #d1d1d1;
        background-color: #e9ecef;
    }

    /* Styling for current month dates */
    .date.current-month {
        cursor: pointer;
        color: #333;
        background-color: #fff;
    }

    /* Hover effect for current month dates */
    .date.current-month:hover {
        background-color: #d1e7ff;
        transform: scale(1.05);
    }

    /* Selected date style */
    .selected {
        background-color: #1cc88a !important;
        color: #fff !important;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 128, 0, 0.2);
    }

    /* Highlighted available date style */
    .highlighted-date {
        background-color: #1cc8894b !important;
        color: #eeffee !important;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(141, 255, 158, 0.3);
    }
    .selected {
        background-color: #1cc88a !important;
        color: #fff !important;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 128, 0, 0.2);
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .calendar-container, .counsellors-container {
            max-width: 100%;
            margin: 0 auto;
        }
    }
    .title {
    font-size: 30px;
    background: linear-gradient(to right, #4d084f, #d084d0);
    -webkit-background-clip: text;
    color: transparent;
}

.dot {
    height: 12px;
    width: 12px;
    background-color: #46b94a; /* Color representing availability */
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
}
h2 {
    font-size: 14px;
    color: #333; /* Main heading color */
}
</style>
{{--  <h2 class = "title m-auto w-20 ">sdfsdf</h2>  --}}
<h2 class="title w-50 m-auto m-4">Booking a session</h2>
<div class="container-row">


    <!-- Calendar Section -->
    <div class="calendar-container">
        <h3 class="filter-title" style="font-size: 24px;">Choose Date</h3>
        <div class="calendar-header">
            <i class="bi bi-chevron-left" onclick="changeMonth(-1)"></i>
            <span id="monthYearDisplay">October 2024</span>
            <i class="bi bi-chevron-right" onclick="changeMonth(1)"></i>
        </div>
        <div class="calendar-days">
            <div class="day">Su</div>
            <div class="day">Mo</div>
            <div class="day">Tu</div>
            <div class="day">We</div>
            <div class="day">Th</div>
            <div class="day">Fr</div>
            <div class="day">Sa</div>
        </div>
        <div class="calendar-dates" id="datesContainer">
            <!-- Dates will be populated by JavaScript -->

        </div>
        <h2>
            <span class="dot"></span> Available Dates
        </h2>
        <hr>

        {{-- Gender Filter --}}
        <div class="gender-filter mt-4">
            <h3 style="font-size: 24px;" class="filter-title"  >Choose Gender</h3>
            <ul class="gender-options d-flex flex-wrap justify-content-center">
                @php
                    $query = request()->query();
                @endphp
                <li class="gender-option m-2">
                    @php $query['gender'] = 'male'; @endphp
                    <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'male' ? 'active' : '' }}">
                        <i class="bi bi-mars"></i> Male
                    </a>
                </li>
                <li class="gender-option m-2">
                    @php $query['gender'] = 'female'; @endphp
                    <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'female' ? 'active' : '' }}">
                        <i class="bi bi-venus"></i> Female
                    </a>
                </li>
                <li class="gender-option m-2">
                    @php unset($query['gender']); @endphp
                    <a href="{{ route('counsellors.index', $query) }}" class="{{ !request('gender') ? 'active' : '' }}">
                        <i class="bi bi-genderless"></i> Any
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <style>
        /* Gender Filter Styling */
        .gender-filter {
            text-align: center;
        }

        .filter-title {
            font-size: 20px;
            color: #632965;
            margin-bottom: 10px;
        }

        .gender-options {
            padding: 0;
            list-style: none;
        }

        .gender-option a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            font-size: 1.5rem;
            color: #632965;
            background-color: #f8f9fa;
            border: 1px solid #d1d1d1;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .gender-option a:hover {
            background-color: #632965;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .gender-option a i {
            margin-right: 8px;
        }

        /* Active styling for selected filter */
        .gender-option a.active {
            background-color: #632965;
            color: #fff;
            font-weight: bold;
            border-color: #632965;
        }
    </style>


    <!-- Counsellors Section -->
    <style>
        /* General container styling */
        .counsellors-container {
            padding: 20px;
            border-radius: 40px;
        }

        /* Counsellor card styling */
        .counsellor-card {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 18px;

        }

        {{--  .counsellor-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }  --}}

        /* Counsellor image styling */
        .counsellor-image {
            width: 100%;
            max-width: 150px;
            height: 150px;
            object-fit: cover;
        }



        /* Layout adjustments for smaller screens */
        @media (max-width: 768px) {
            .counsellors-container {
                padding: 10px;
            }

            .counsellor-card {
                margin-bottom: 20px;
            }

            .card-title {
                font-size: 24px;
            }

            .card-subtitle {
                font-size: 14px;
            }

            .card-text {
                font-size: 14px;
            }

            .see-more-link {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .counsellor-image {
                max-width: 100px;
                margin-bottom: 10px;
            }

        }
        .box{
            background-color: #ffe66c44;
        }

        .pagination-links{
            color: #632965;
            width: fit-content;
            margin: 0px auto;
        }

    </style>

    <div class="counsellors-container col-12 col-lg-7 col-md-12 mb-4">
        <div class="justify-content-center p-3 p-lg-5">
            @if($counsellors->isEmpty())
            <div class="text-center py-5">
                <div class="card shadow-lg border-0 mx-auto box1" style="max-width: 600px;">
                    <div class="card-body box">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-exclamation-circle-fill" style="font-size: 3rem; color: #010101;"></i>
                        </div>
                        <h4 class="text-muted mb-3">No Counsellors Available</h4>
                        <p class="text-muted">Please check back later for new availability.</p>
                    </div>
                </div>
            </div>
        @else
            @foreach ($counsellors as $counsellor)
                <div class="col-12 mb-4">
                    <div class="card counsellor-card shadow">
                        <div class="row no-gutters align-items-center">
                            <!-- Counsellor image column -->
                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center py-3">
                                <img src="{{ $counsellor->profile_image
                                    ? asset('storage/' . $counsellor->profile_image)
                                    : ($counsellor->gender === 'male'
                                        ? 'https://t4.ftcdn.net/jpg/02/44/43/69/360_F_244436923_vkMe10KKKiw5bjhZeRDT05moxWcPpdmb.jpg'
                                        : 'https://static.vecteezy.com/system/resources/previews/000/350/779/non_2x/vector-female-student-icon.jpg') }}"
                                     class="counsellor-image"
                                     alt="{{ $counsellor->full_name_with_rate }}">
                            </div>

                            <!-- Counsellor details column -->
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $counsellor->full_name_with_rate }}</h5>
                                    <p class="card-subtitle text-muted">{{ $counsellor->title }}</p>
                                    <hr>
                                    <p class="card-text">{{ $counsellor->intro }}</p>
                                    <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id]) }}" class="see-more-link text-primary">
                                        See more about {{ $counsellor->full_name_with_rate }} >
                                    </a>

                                    <div class="row mt-4">
                                        <div class="col-7">
                                            <p class="text-muted mb-2"><strong>Next available</strong></p>
                                            @if (isset($counsellor->nextAvailableSlot['date']) && isset($counsellor->nextAvailableSlot['time']))
                                                <p class="text-success mb-3">
                                                    {{ $counsellor->nextAvailableSlot['date'] }} at {{ $counsellor->nextAvailableSlot['time'] }}
                                                </p>
                                            @else
                                                <p class="text-danger mb-3">No available slots</p>
                                            @endif
                                        </div>

                                        @php
                                        // Check if 'date' is present in the request URL; otherwise, use the next available slot date.
                                        $selectedDate = request('date')
                                                        ?? (isset($counsellor->nextAvailableSlot['date'])
                                                            ? \Carbon\Carbon::parse($counsellor->nextAvailableSlot['date'])->format('Y-m-d')
                                                            : null);
                                    @endphp

                                    <div class="col-5 text-right">
                                        @if ($counsellor->nextAvailableSlot)
                                            <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id]) }}?date={{ $selectedDate }}"
                                               class="btn btn-primary btn-sm px-5">
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
        @endif

            <!-- Pagination Links -->
            <div class="pagination-links">
                {{ $counsellors->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>


<script>
    const monthYearDisplay = document.getElementById("monthYearDisplay");
    const datesContainer = document.getElementById("datesContainer");
    let currentDate = new Date();

    const availableDates = @json($eventDates);

    // Parse the date from the URL, if present
    const urlParams = new URLSearchParams(window.location.search);
    const selectedDate = urlParams.get('date');  // e.g., "2024-11-01"

    function generateCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYearDisplay.innerText = `${currentDate.toLocaleString("default", { month: "long" })} ${year}`;
        datesContainer.innerHTML = "";  // Clear previous dates

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

        // Dates from the previous month
        for (let i = firstDayOfMonth - 1; i >= 0; i--) {
            const prevMonthDateDiv = document.createElement("div");
            prevMonthDateDiv.classList.add("date", "previous-month");
            prevMonthDateDiv.innerText = lastDateOfPrevMonth - i;
            datesContainer.appendChild(prevMonthDateDiv);
        }

        // Dates of the current month
        for (let day = 1; day <= lastDateOfMonth; day++) {
            const dateDiv = document.createElement("div");
            dateDiv.classList.add("date", "current-month");
            dateDiv.innerText = day;

            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            if (availableDates.includes(dateStr)) {
                dateDiv.classList.add("highlighted-date");
            }

            // Highlight the date if it matches the URL date parameter
            if (dateStr === selectedDate) {
                dateDiv.classList.add("selected");
            }

            dateDiv.addEventListener("click", () => selectDate(dateDiv, dateStr));
            datesContainer.appendChild(dateDiv);
        }

        const remainingCells = 42 - datesContainer.children.length;
        for (let i = 1; i <= remainingCells; i++) {
            const nextMonthDateDiv = document.createElement("div");
            nextMonthDateDiv.classList.add("date", "next-month");
            nextMonthDateDiv.innerText = i;
            datesContainer.appendChild(nextMonthDateDiv);
        }
    }

    function changeMonth(direction) {
        currentDate.setMonth(currentDate.getMonth() + direction);
        generateCalendar();
    }

    function selectDate(selectedDiv, dateStr) {
        document.querySelectorAll(".date").forEach(date => date.classList.remove("selected"));
        selectedDiv.classList.add("selected");
        window.location.href = `?date=${dateStr}`;
    }

    generateCalendar();
</script>


@endsection
