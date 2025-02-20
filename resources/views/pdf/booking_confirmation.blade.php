<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* A4 page dimensions */
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }
        .container {
            width: 100%;
            max-width: 794px; /* A4 width minus margins */
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            color: #74148c;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            color: #555;
            margin: 5px 0 20px 0;
        }
        hr {
            border: 0;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            color: #74148c;
            border-bottom: 2px solid #74148c;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .details p {
            margin: 5px 0;
            font-size: 14px;
        }
        .details .field-label {
            font-weight: bold;
            color: #74148c;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .highlight {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="https://firebasestorage.googleapis.com/v0/b/portf-cef98.appspot.com/o/logo2.png?alt=media&token=0e3d15c1-6500-4c42-a3ee-6b5527b4b76c" alt="Logo">
            <h1>Booking Confirmation</h1>
            <p>Invoice Number: {{ $bookingID }}</p>
        </div>

        <!-- Booking Summary Section -->
        <div class="section">
            <h2>Booking Summary</h2>
            <div class="details">
                <p><span class="field-label">Invoice Number:</span> {{ $bookingID }}</p>
                <p><span class="field-label">Date:</span> {{ $bookingDate }}</p>
                <p><span class="field-label">Time:</span> {{ $bookingTime }}</p>
            </div>
        </div>

        <!-- Session Details Section -->
        <div class="section">
            <h2>Session Details</h2>
            <div class="details">
                <p><span class="field-label">Counselor Name:</span> {{ $counsellor->full_name_with_rate }}</p>
                <p><span class="field-label">Session Date:</span> {{ $timeslot->date }}</p>
                <p><span class="field-label">Session Time:</span> {{ date('h:i A', strtotime($timeslot->time)) }}</p>
                <p><span class="field-label">Location:</span> Sitharana Counseling Center, Faculty of Social Sciences & Languages, SUSL</p>
            </div>
        </div>

        <!-- Client Details Section -->
        <div class="section">
            <h2>Client Details</h2>
            <div class="details">
                <p><span class="field-label">Client Name:</span> {{ $formDetails['name'] }}</p>
                <p><span class="field-label">Email:</span> {{ $formDetails['email'] }}</p>
                <p><span class="field-label">Phone:</span> {{ $formDetails['mobile_no'] }}</p>
                <p><span class="field-label">Faculty:</span> {{ $formDetails['faculty'] }}</p>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="section">
            <h2>Important Instructions</h2>
            <div class="highlight">
                <p>Please arrive at least 15 minutes before your scheduled session. Bring any necessary documents with this document or identification as mentioned in the booking details.</p>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>For further assistance, contact us at:</p>
            <p><strong>Phone:</strong> +9475965738 | <strong>Email:</strong> sitharana@ssl.sab.ac.lk</p>
            <p>Sitharana Psychological Counseling Center © 2025, Sabaragamuwa University of Sri Lanka. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
