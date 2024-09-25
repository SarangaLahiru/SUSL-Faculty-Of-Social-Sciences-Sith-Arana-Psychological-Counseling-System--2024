@extends('counsellors.dashboard.dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Your Booking Dashboard</h1>
        <p class="text-center mb-4">Manage and view your upcoming bookings below:</p>

        @if($bookings->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No bookings available at the moment. Please check back later!
            </div>
        @else
        <ul class="list-group">
            @foreach($bookings as $booking)
                <li class="list-group-item d-flex justify-content-between align-items-center m-1 border rounded shadow-sm">
                    <div class="d-flex">
                        <h5 class="mb-1">
                            {{ \Carbon\Carbon::parse($booking->timeSlot->date)->format('m/d/Y') }} at {{ \Carbon\Carbon::parse($booking->timeSlot->time)->format('g:i A') }}
                        </h5>
                        <p class="mb-1"><strong>Client:</strong> {{ $booking->name ? $booking->name : 'Anonymous' }}</p>
                        <p class="mb-1"><strong>Contact:</strong> {{ $booking->mobile_no }}</p>
                    </div>
                    <div>
                        <!-- View button triggers modal -->
                        <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewBookingModal"

                        data-booking-id="{{ $booking->booking_id }}"
                        data-booking-name="{{ $booking->name }}"
                        data-booking-email="{{ $booking->email }}"
                        data-booking-contact="{{ $booking->mobile_no }}"
                        data-booking-date="{{ \Carbon\Carbon::parse($booking->timeSlot->date)->format('m/d/Y') }}"
                        data-booking-time="{{ \Carbon\Carbon::parse($booking->timeSlot->time)->format('g:i A') }}"
                        data-booking-faculty="{{ $booking->faculty }}"
                        data-booking-message="{{ $booking->message }}"
                        data-booking-reg-no="{{ $booking->registration_no }}"

                        >

                                 <i class="fas fa-eye"></i>
                        </button>

                        <form action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        @endif
    </div>

    <!-- Modal for Viewing Booking Details -->
    <div class="modal fade" id="viewBookingModal" tabindex="-1" aria-labelledby="viewBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewBookingModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Date:</strong> <span id="bookingDate"></span></p>
                    <p><strong>Time:</strong> <span id="bookingTime"></span></p>
                    <p><strong>Client Name:</strong> <span id="bookingName"></span></p>
                    <p><strong>Email:</strong> <span id="bookingEmail"></span></p> <!-- Email -->
                    <p><strong>Contact Number:</strong> <span id="bookingContact"></span></p>
                    <p><strong>Faculty:</strong> <span id="bookingFaculty"></span></p> <!-- Faculty -->
                    <p><strong>Message:</strong> <span id="bookingMessage"></span></p> <!-- Message -->
                    <p><strong>Registration No:</strong> <span id="bookingRegNo"></span></p> <!-- Registration No -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // jQuery to handle modal data population
        document.addEventListener('DOMContentLoaded', function () {
            const bookingModal = document.getElementById('viewBookingModal');
            bookingModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const date = button.getAttribute('data-booking-date');
                const time = button.getAttribute('data-booking-time');
                const name = button.getAttribute('data-booking-name');
                const email = button.getAttribute('data-booking-email'); // Get email
                const contact = button.getAttribute('data-booking-contact');
                const faculty = button.getAttribute('data-booking-faculty'); // Get faculty
                const message = button.getAttribute('data-booking-message'); // Get message
                const regNo = button.getAttribute('data-booking-reg-no'); // Get registration no

                // Update the modal's content
                bookingModal.querySelector('#bookingDate').textContent = date;
                bookingModal.querySelector('#bookingTime').textContent = time;
                bookingModal.querySelector('#bookingName').textContent = name;
                bookingModal.querySelector('#bookingEmail').textContent = email; // Set email
                bookingModal.querySelector('#bookingContact').textContent = contact;
                bookingModal.querySelector('#bookingFaculty').textContent = faculty; // Set faculty
                bookingModal.querySelector('#bookingMessage').textContent = message; // Set message
                bookingModal.querySelector('#bookingRegNo').textContent = regNo; // Set registration no
            });
        });
    </script>
@endsection




