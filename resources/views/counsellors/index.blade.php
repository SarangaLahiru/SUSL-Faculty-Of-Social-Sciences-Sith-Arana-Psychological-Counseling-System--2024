@extends('layout')

@section('title', 'Sith Arana | Counsellors')

@section('content')
<div>
    <div class="showcase text-center mt-5">
        <h1>Book a session</h1>
        <p>Book a session with our qualified Counsellors</p>
    </div>

    <div class="box mt-5">
        <div class="row">
            {{-- Filters section --}}
            <div class="col-sm-12 col-lg-5 mb-4 col-md-12 p-5 filters">
                <div class="card" >
                    <div class="card-body">
                        {{-- Days filter --}}
                        <div class="filters-body">
                            <div class="days-filter mb-4">
                                <h3>Available dates</h3>
                                <div id="datepicker" class="datepicker-inline shadow rounded-3"></div>
                            </div>

                            {{-- Gender filter --}}
                            <div class="gender-filter">
                                <h3>Gender</h3>
                                <ul class="list-unstyled d-flex">
                                    @php
                                        $query = request()->query(); // Capture existing query parameters
                                    @endphp
                                    <li class="m-2">
                                        @php
                                            $query['gender'] = 'male';
                                        @endphp
                                        <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'male' ? 'active' : '' }}">Male</a>
                                    </li>
                                    <li class="m-2">
                                        @php
                                            $query['gender'] = 'female';
                                        @endphp
                                        <a href="{{ route('counsellors.index', $query) }}" class="{{ request('gender') == 'female' ? 'active' : '' }}">Female</a>
                                    </li>
                                    <li class="m-2">
                                        @php
                                            unset($query['gender']);
                                        @endphp
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
                                        : 'https://static.vecteezy.com/system/resources/previews/000/350/779/non_2x/vector-female-student-icon.jpg')
                                }}"
                                        class="counsellor-image p-3 p-md-4 rounded img-fluid"

                                        >
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 28px">{{ $counsellor->full_name_with_rate }}</h5>
                                        <p class="card-subtitle mb-2 text-muted" style="font-size: 16px" >{{ $counsellor->title }}</p>
                                        <hr>
                                        <p class="card-text">{{ $counsellor->intro }}</p>
                                        <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id]) }}" class="see-more-link">See more about {{ $counsellor->full_name_with_rate }} ></a>

                                        <div class="row mt-4 mt-md-5">
                                            <div class="col-7">
                                                <p class="mb-2 text-muted" style="font-size: 14px;"><strong>Next available</strong></p>
                                                {{--  <p class="text-primary mb-3" style="font-size: 14px; " >Today 10.30am</p>  --}}
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
                                                <a href="{{ route('counsellors.show', ['counsellor' => $counsellor->counsellor_id, 'date' => \Carbon\Carbon::parse($counsellor->nextAvailableSlot['date'])->format('Y-m-d'), 'counsellor_id' => $counsellor->counsellor_id]) }}"
                                                    class="btn-gradient-primary" {{ !$counsellor->nextAvailableSlot ? 'disabled' : '' }}>
                                                     Book Now
                                                 </a>

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

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<script>
    $(document).ready(function() {
        var selectedDate = "{{ $selectedDate }}"; // Get the selected date from the server

        $('#datepicker').datepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
            autoclose: true // Close datepicker on date selection
        }).datepicker('setDate', new Date(selectedDate)); // Set the initial date

        $('#datepicker').on('changeDate', function() {
            var selectedDate = $('#datepicker').datepicker('getFormattedDate');
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set('date', selectedDate); // Set the new date parameter

            // Maintain other query parameters (like gender)
            window.location.search = params.toString();
        });
    });
</script>
@endsection
