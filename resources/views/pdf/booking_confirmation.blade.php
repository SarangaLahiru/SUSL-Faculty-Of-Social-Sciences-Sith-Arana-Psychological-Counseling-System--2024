<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Main styling for A4 PDF dimensions */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 210mm;
            padding: 20mm;
            box-sizing: border-box;
            margin-left: -100px
        }
        h1 {
            color: #74148c;
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }


        hr {
            border: 0;
            border-top: 2px solid #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .details {
            margin: 20px 0;
            line-height: 1.5;
            font-size: 14px;
        }
        .details p {
            margin: 10px 0;
        }
        .field-label {
            font-weight: bold;
            color: #74148c;
        }
        .contact-info {
            margin-top: 60px;
            color: #666;
        }
        .contact-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo section -->
        <div class="logo">
            <img src="https://firebasestorage.googleapis.com/v0/b/portf-cef98.appspot.com/o/logo2.png?alt=media&token=0e3d15c1-6500-4c42-a3ee-6b5527b4b76c" alt="Sitharana Logo" >
        </div>

        <hr>

        <!-- Title section -->
        <h1>Invoice Number: {{ $bookingID }}</h1>

        <!-- Invoice and Booking details section -->
        <div class="details">
            <p><span class="field-label">Invoice Number:</span> {{ $bookingID }}</p>
            <p><span class="field-label">Date:</span> {{ $bookingDate }}</p>
            <p><span class="field-label">Time:</span> {{ $bookingTime }}</p>
        </div>

        <!-- Booking details section -->
        <div class="details">
            <p><span class="field-label">Counselor Name:</span> {{ $counsellor->full_name_with_rate }}</p>
            <p><span class="field-label">Session Date:</span> {{ $timeslot->date }}</p>
            <p><span class="field-label">Session Time:</span> {{ date('h:i A', strtotime($timeslot->time)) }}</p>
            <p><span class="field-label">Location:</span> Sitharana Counseling Center, Faculty of Social Sciences & Languages, SUSL</p>
        </div>

        <!-- Client details section -->
        <div class="details">
            <p><span class="field-label">Client Name:</span> {{ $formDetails['name'] }}</p>
            <p><span class="field-label">Email:</span> {{ $formDetails['email'] }}</p>
            <p><span class="field-label">Phone:</span> {{ $formDetails['mobile_no'] }}</p>
            <p><span class="field-label">Faculty:</span> {{ $formDetails['faculty'] }}</p>
        </div>

        <!-- Contact information section -->
        <div class="contact-info">
            <p>For further assistance, feel free to contact us:</p>
            <p><strong>Phone:</strong> +9475965738</p>
            <p><strong>Email:</strong> infocounsellor@gmail.com</p>
        </div>

        <!-- Footer section -->
        <div class="footer">
            <p>Sitharana Psychological Counseling Center © 2024, Sabaragamuwa University of Sri Lanka. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
