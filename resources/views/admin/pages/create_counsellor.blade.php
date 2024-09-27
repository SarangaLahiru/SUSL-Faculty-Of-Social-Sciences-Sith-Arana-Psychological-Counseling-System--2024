@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Add Counsellor</h1>

    <form action="{{ route('counsellorsShow.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="counsellor_id">counsellor id</label>
            <input type="text" name="counsellor_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="full_name_with_rate">Full Name with Rate</label>
            <input type="text" name="full_name_with_rate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mobile_no">Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="intro">Intro</label>
            <textarea name="intro" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control" required></textarea>
        </div>
        <div id="timeSlotsContainer">
            <h3>Time Slots</h3>
            <div class="timeSlot">
                <label>Date:</label>
                <input type="date" name="time_slots[0][date]" required>
                <label>Time:</label>
                <input type="time" name="time_slots[0][time]" required>
            </div>
        </div>

        <button type="button" onclick="addTimeSlot()">Add Another Time Slot</button>

        <button type="submit">Save Counsellor</button>
    </form>
    </form>
</div>

<script>
    let timeSlotCount = 1;

    function addTimeSlot() {
        const container = document.getElementById('timeSlotsContainer');
        const newSlot = document.createElement('div');
        newSlot.classList.add('timeSlot');
        newSlot.innerHTML = `
            <label>Date:</label>
            <input type="date" name="time_slots[${timeSlotCount}][date]" required>
            <label>Time:</label>
            <input type="time" name="time_slots[${timeSlotCount}][time]" required>
        `;
        container.appendChild(newSlot);
        timeSlotCount++;
    }
</script>

@endsection
