@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h1 class="my-4">Counsellor Bookings</h1>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="accordion" id="bookingAccordion">
            @foreach($bookingsByCounsellor as $counsellorName => $bookings)
                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-purple text-white d-flex justify-content-between">
                        <h5 class="my-0">{{ $counsellorName }}</h5>
                    </div>

                    <div class="card-body" style="background-color: #f5f3f0;">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr class="align-items-center">
                                        <td class="border-0">
                                            <button class="btn btn-outline-secondary btn-sm" style="font-size: 24px;">{{ \Carbon\Carbon::parse($booking->timeSlot->date)->format('d/m') }}</button>
                                        </td>
                                        <td class="border-0">
                                            <button class="btn btn-outline-secondary btn-sm"  style="font-size: 24px;">{{ \Carbon\Carbon::parse($booking->timeSlot->time)->format('h:ia') }}</button>
                                        </td>
                                        <td class="border-0 d-flex justify-content-end">
                                            {{--  <!-- Edit Button -->
                                            <a href="" class="btn btn-outline-secondary btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>  --}}

                                            <!-- Delete Button -->
                                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" style="font-size: 24px;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .bg-purple {
            background-color: #622864;
        }

        .table button {
            border-radius: 20px;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid #e0e0e0;
        }

        .table td {
            padding: 0.5rem;
        }

        .table td:first-child {
            width: 20%;
        }

        .table td:last-child {
            width: 30%;
        }

        .card-header {
            padding: 1rem;
            font-weight: bold;
        }

        .btn-outline-secondary {
            color: #622864;
            border-color: #622864;
        }

        .btn-outline-secondary:hover {
            background-color: #6f42c1;
            color: white;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
    </style>
@endsection
