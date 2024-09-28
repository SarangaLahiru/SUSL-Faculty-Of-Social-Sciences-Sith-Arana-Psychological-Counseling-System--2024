@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Add Counsellor</h1>

    <form action="{{ route('counsellorsShow.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{--  <!-- Profile Image -->
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
            @error('profile_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Counsellor ID -->
        <div class="form-group">
            <label for="counsellor_id">Counsellor ID</label>
            <input type="text" name="counsellor_id" class="form-control" required>
            @error('counsellor_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        <!-- Full Name with Rate -->
        <div class="form-group">
            <label for="full_name_with_rate">Full Name with Rate</label>
            <input type="text" name="full_name_with_rate" class="form-control" required>
            @error('full_name_with_rate')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <!-- Username -->
        <div class="form-group">
            <label for="username">NIC number</label>
            <input type="text" name="NIC" class="form-control" required>
            @error('NIC')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{--  <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Gender -->
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Mobile No -->
        <div class="form-group">
            <label for="mobile_no">Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" required>
            @error('mobile_no')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{--  <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Intro -->
        <div class="form-group">
            <label for="intro">Intro</label>
            <textarea name="intro" class="form-control" required></textarea>
            @error('intro')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Bio -->
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control" required></textarea>
            @error('bio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>  --}}

        {{--  <!-- Time Slots Section -->
        <div id="timeSlotsContainer">
            <h3>Time Slots</h3>
            <div class="timeSlot">
                <label>Date:</label>
                <input type="date" name="time_slots[0][date]" >
                @error('time_slots.0.date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <label>Time:</label>
                <input type="time" name="time_slots[0][time]" >
                @error('time_slots.0.time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>  --}}

        {{--  <button type="button" onclick="addTimeSlot()">Add Another Time Slot</button>  --}}

        <button type="submit" class="btn btn-primary mt-3">Save Counsellor</button>
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
            <input type="date" name="time_slots[${timeSlotCount}][date]" >
            <label>Time:</label>
            <input type="time" name="time_slots[${timeSlotCount}][time]" >
        `;
        container.appendChild(newSlot);
        timeSlotCount++;
    }
</script>

@endsection
