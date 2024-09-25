@extends('counsellors.dashboard.dashboard')

@section('content')
    <h1>Availability</h1>
    <ul class="list-group">
        @foreach ($availability as $slot)
            <li class="list-group-item">
                {{ $slot['date'] }} - {{ $slot['time'] }} -
                <span class="{{ $slot['isBooked'] ? 'text-danger' : 'text-success' }}">
                    {{ $slot['isBooked'] ? 'Booked' : 'Available' }}
                </span>
            </li>
        @endforeach
        @if (empty($availability))
            <li class="list-group-item">No time slots available.</li>
        @endif
    </ul>

@endsection
