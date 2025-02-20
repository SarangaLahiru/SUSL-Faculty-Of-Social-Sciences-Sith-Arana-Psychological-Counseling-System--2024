@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h1 class="my-4">Add Counsellor</h1>

        <form action="{{ route('counsellorsShow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Full Name with Rate -->
            <div class="form-group">
                <label for="full_name_with_rate">Full Name with Rate</label>
                <input type="text" name="full_name_with_rate" class="form-control" required>
                @error('full_name_with_rate')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIC number -->
            <div class="form-group">
                <label for="NIC">NIC number</label>
                <input type="text" name="NIC" class="form-control" required>
                @error('NIC')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Weekly Time Slots Section -->
            <div id="weeklyTimeSlotsContainer">

                <h3>Weekly Schedule</h3>
                <label>Weeks</label>
                <input type="number" name="weeks" required>
                <div class="timeSlot">
                    <label>Day of the Week:</label>
                    <select name="time_slots[0][day_of_week]" class="form-control" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    <label>Time:</label>
                    <input type="time" name="time_slots[0][time]" class="form-control" required>

                    <input type="number" id="custom-duration" name="custom-weeks" class="form-control mt-2"
                           style="display:none;" placeholder="Enter custom duration (minutes)"/>

                    <label>Duration (minutes):</label>

                    <input type="number" name="time_slots[0][duration]" class="form-control" min="15" max="120"
                           step="15" value="30" required>


                </div>
            </div>

            <button type="button" onclick="addDaySlot()">Add Another Day and Time Slot</button>

            <button type="submit" class="btn btn-primary mt-3">Save Counsellor</button>
        </form>
    </div>

    <script>
        let timeSlotCount = 1;

        function addDaySlot() {
            const container = document.getElementById('weeklyTimeSlotsContainer');
            const newSlot = document.createElement('div');
            newSlot.classList.add('timeSlot');
            newSlot.innerHTML = `
            <label>Day of the Week:</label>
            <select name="time_slots[${timeSlotCount}][day_of_week]" class="form-control" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <label>Time:</label>
            <input type="time" name="time_slots[${timeSlotCount}][time]" class="form-control" required>
            <label>Duration (minutes):</label>
            <input type="number" name="time_slots[${timeSlotCount}][duration]" class="form-control" min="15" max="120" step="15" value="30" required>
        `;
            container.appendChild(newSlot);
            timeSlotCount++;
        }


    </script>
@endsection





