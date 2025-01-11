@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h2>Delete All Time Slots</h2>
        <p>Are you sure you want to delete all your time slots? This action cannot be undone.</p>
        <form action="{{ route('admin.deleteTimeSlots', $counsellor->counsellor_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Delete All Time Slots</button>
            <a href="{{ route('admin.counsellors') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Add New Time Slots</h2>
        <form action="{{ route('admin.addTimeSlots', $counsellor->counsellor_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="weeks" class="form-label">Number of Weeks to Generate</label>
                <input type="number" name="weeks" id="weeks" class="form-control" min="1" max="52" required>
            </div>

            <div id="timeSlotsContainer">
                <div class="time-slot mb-3">
                    <label for="day_of_week" class="form-label">Day of Week</label>
                    <select name="time_slots[0][day_of_week]" class="form-control" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>

                    <label for="time" class="form-label mt-2">Time</label>
                    <input type="time" name="time_slots[0][time]" class="form-control" required>

                    <label for="duration" class="form-label mt-2">Duration (minutes)</label>
                    <input type="number" name="time_slots[0][duration]" class="form-control" min="15" max="120" required>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="addTimeSlot()">Add Another Time Slot</button>
            <button type="submit" class="btn btn-primary mt-3">Add Time Slots</button>
        </form>
    </div>

    <script>
        let slotIndex = 1;

        function addTimeSlot() {
            const container = document.getElementById('timeSlotsContainer');
            const newSlot = document.createElement('div');
            newSlot.classList.add('time-slot', 'mb-3');
            newSlot.innerHTML = `
            <label for="day_of_week" class="form-label">Day of Week</label>
            <select name="time_slots[${slotIndex}][day_of_week]" class="form-control" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>

            <label for="time" class="form-label mt-2">Time</label>
            <input type="time" name="time_slots[${slotIndex}][time]" class="form-control" required>

            <label for="duration" class="form-label mt-2">Duration (minutes)</label>
            <input type="number" name="time_slots[${slotIndex}][duration]" class="form-control" min="15" max="120" required>
        `;
            container.appendChild(newSlot);
            slotIndex++;
        }
    </script>

@endsection
