@extends('admin.dashboard')

@section('content')
    <h1>Bookings</h1>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Faculty</th>
                <th>Registration No</th>
                <th>Message</th>
                <th>Counsellor Name</th>
                <th>Time Slot</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_id }}</td>
                    <td>{{ $booking->mobile_no }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->faculty }}</td>
                    <td>{{ $booking->registration_no }}</td>
                    <td>{{ $booking->message }}</td>
                    <td>{{ $booking->counsellor->full_name_with_rate }}</td>
                    <td>{{ $booking->timeSlot->date }} - {{ $booking->timeSlot->time }}</td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('admin.bookings.destroy', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
