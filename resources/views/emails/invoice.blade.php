@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/invoice.css') }}">

<div class="container mt-5" style="margin: 30px auto" data-aos="zoom-in-up">

        <div class="success-msg">
            <div class="d-flex align-items-center justify-content-center">
                <img src="/images/ok.png" alt="">
                <strong>You have successfully sent a booking request </strong>
            </div>
        </div>
        


        <div class="card">
        <div class="alert alert-warning" role="alert">
    <strong>Note:</strong> Stay alert for an email until the counselor confirms your request.
</div>
            <div class=" text-white text-center p-2 mb-3 card-body-title card-header">
                <h5>Invoice number: <span>{{ $bookingDetail['booking_id'] }}</span></h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>Counsellor name: <span>{{ $counsellor->full_name_with_rate }}</span></h5>
                </div>
                <div class="mb-4">
                    <h5>Date: <span>{{ $timeslot['date'] }}</span></h5>
                </div>
                <div class="mb-4">
                    <h5>Time: <span>{{ date('h:i A', strtotime($timeslot['time'])) }}</span></h5>
                </div>
                <div class="mb-4">
                    <h5>Location: Sitharana, Faculty of Social Sciences & Languages</h5>
                </div>
              
                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3 dis">
                    <div class="text-center">
                        <h6><i class="bi bi-envelope mr-2"></i>infocounsellor@gmail.com</h6>
                    </div>
                    <div class="text-center">
                        <h6><i class="bi bi-phone mr-2"></i>+9475965738</h6>
                    </div>




                </div>
                {{--  <div class="download" style="margin: 50px auto">
                    <a href="{{ $pdfPath }}" download="booking_confirmation.pdf" class="btn-gradient">Download</a>
                   </div>  --}}
                <div class="download" style="margin: 50px auto">
                    <a href="/" class="btn-gradient">Go To Home</a>
                </div>


            </div>

        </div>



    </div>


</div>

@endsection
