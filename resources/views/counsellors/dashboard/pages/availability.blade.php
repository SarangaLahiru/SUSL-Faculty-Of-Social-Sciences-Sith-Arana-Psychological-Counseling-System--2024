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

    <!-- Form to Add Multiple Time Slots -->
    <h2>Add New Time Slots</h2>
    <form action="{{ route('counsellors.availability.store') }}" method="POST">
        @csrf
        <div id="time-slots-container">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date[]" id="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" name="time[]" id="time" class="form-control" required>
            </div>
        </div>

        <!-- Button to add more time slots -->
        <button type="button" id="add-time-slot" class="btn btn-secondary mt-3">Add Another Time Slot</button>

        <!-- Submit form -->
        <button type="submit" class="btn btn-primary mt-3">Add Time Slots</button>
    </form>

    <!-- Success or Error Messages -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <script>
        // JavaScript to dynamically add more time slot inputs
        document.getElementById('add-time-slot').addEventListener('click', function() {
            let container = document.getElementById('time-slots-container');

            let dateGroup = document.createElement('div');
            dateGroup.classList.add('form-group');
            dateGroup.innerHTML = '<label for="date">Date:</label><input type="date" name="date[]" class="form-control" required>';
            container.appendChild(dateGroup);

            let timeGroup = document.createElement('div');
            timeGroup.classList.add('form-group');
            timeGroup.innerHTML = '<label for="time">Time:</label><input type="time" name="time[]" class="form-control" required>';
            container.appendChild(timeGroup);
        });
    </script>


@endsection


