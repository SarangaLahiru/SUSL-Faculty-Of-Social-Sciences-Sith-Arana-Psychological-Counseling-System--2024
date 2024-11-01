@extends('counsellors.dashboard.dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Your Bookings</h1>

        @if($bookings->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No bookings available at the moment. Please check back later!
            </div>
        @else
        <ul class="list-group">
            @foreach($bookings as $booking)
                <li class="list-group-item d-flex justify-content-between align-items-center m-2 border rounded shadow-lg">
                    <!-- Booking Date and Time -->
                    <div class="d-flex flex-colum align-items-center booking-date-time p-2">
                        <div class="booking-date">{{ \Carbon\Carbon::parse($booking->timeSlot->date)->format('y/m/d') }}</div>
                        <div class="booking-time">{{ \Carbon\Carbon::parse($booking->timeSlot->time)->format('g:i A') }}</div>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-info p-2">
                        <span class="">{{ $booking->mobile_no }}</span>
                    </div>

                    <!-- Client Name -->
                    <div class="client-name p-2">
                        <span class="">{{ $booking->name ? $booking->name : '-' }}</span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons d-flex align-items-center">
                        <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewBookingModal"
                        data-bs-toggle="tooltip" title="View Booking"
                        data-booking-id="{{ $booking->booking_id }}"
                        data-booking-name="{{ $booking->name }}"
                        data-booking-email="{{ $booking->email }}"
                        data-booking-contact="{{ $booking->mobile_no }}"
                        data-booking-date="{{ \Carbon\Carbon::parse($booking->timeSlot->date)->format('m/d/Y') }}"
                        data-booking-time="{{ \Carbon\Carbon::parse($booking->timeSlot->time)->format('g:i A') }}"
                        data-booking-faculty="{{ $booking->faculty }}"
                        data-booking-message="{{ $booking->message }}"
                        data-booking-reg-no="{{ $booking->registration_no }}">
                            <i class="fas fa-eye"></i>
                        </button>

                        <!-- Delete Booking -->
                        <form action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Are you sure you want to delete this booking?');" data-bs-toggle="tooltip" title="Delete Booking">
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Gradient header with custom color and white text -->
                <div class="modal-header" style="background: linear-gradient(45deg, #622864, #b15a9e); color: white;">
                    <h5 class="modal-title" id="viewBookingModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body with styled content -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Date:</strong> <span id="bookingDate" class="text-muted"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Time:</strong> <span id="bookingTime" class="text-muted"></span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Client Name:</strong> <span id="bookingName" class="text-muted"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> <span id="bookingEmail" class="text-muted"></span></p> <!-- Email -->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Contact Number:</strong> <span id="bookingContact" class="text-muted"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Faculty:</strong> <span id="bookingFaculty" class="text-muted"></span></p> <!-- Faculty -->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Message:</strong> <span id="bookingMessage" class="text-muted"></span></p> <!-- Message -->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Registration No:</strong> <span id="bookingRegNo" class="text-muted"></span></p> <!-- Registration No -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer with custom button colors -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{--  <button type="button" class="btn btn-primary">Take Action</button> <!-- Example button for further actions -->  --}}
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
                const email = button.getAttribute('data-booking-email');
                const contact = button.getAttribute('data-booking-contact');
                const faculty = button.getAttribute('data-booking-faculty');
                const message = button.getAttribute('data-booking-message');
                const regNo = button.getAttribute('data-booking-reg-no');

                // Update the modal's content
                bookingModal.querySelector('#bookingDate').textContent = date;
                bookingModal.querySelector('#bookingTime').textContent = time;
                bookingModal.querySelector('#bookingName').textContent = name;
                bookingModal.querySelector('#bookingEmail').textContent = email;
                bookingModal.querySelector('#bookingContact').textContent = contact;
                bookingModal.querySelector('#bookingFaculty').textContent = faculty;
                bookingModal.querySelector('#bookingMessage').textContent = message;
                bookingModal.querySelector('#bookingRegNo').textContent = regNo;
            });
        });

        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>

    <style>
        .list-group-item {
            background-color: #f5f3f0;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
        }

        .booking-date {
            font-size: 18px;
            color: #622864;
            padding: 10px 15px;
            border: 2px solid #622864;
            border-radius: 24px;
            margin: 2px 10px
        }

        .booking-time {
            font-size: 18px;
            color: #622864;
            padding: 10px 15px;
            border: 2px solid #622864;
            border-radius: 24px;
            margin: 2px 10px;
        }

        .contact-info {
            font-size: 24px;
            color: #622864;
        }

        .client-name {
            font-size: 24px;
            font-weight: bold;
            color: #622864;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .btn-sm {
            background-color: #f2f2f2;
            border: none;
            color: #555;
            padding: 5px 10px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn-sm:hover {
            background-color: #e0e0e0;
        }

        @media (max-width: 768px) {
            .list-group-item {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
@endsection
