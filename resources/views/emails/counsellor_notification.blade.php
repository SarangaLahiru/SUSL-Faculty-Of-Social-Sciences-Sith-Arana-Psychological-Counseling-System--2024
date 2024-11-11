<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px rgb(219, 219, 219) solid;
        }
        h1 {
            color: #72148c;
            text-align: center;
            font-size: 26px;
            margin-top: 0;
        }
        .intro {
            font-size: 18px;
            margin-bottom: 20px;
            color: #72148c;
            text-align: center;
            font-weight: bold;
        }
        .details {
            background-color: #f8f9fa;
            border-left: 4px solid #72148c;
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            margin: 20px auto;
            padding: 12px 24px;
            background-color: #72148c;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #5a0e6e;
        }
        .icon {
            text-align: center;
            font-size: 50px;
            color: #72148c;
            margin-bottom: 15px;
        }
        .header-bar {
            background-color: #72148c;
            height: 8px;
            border-radius: 8px 8px 0 0;
            margin-top: -20px;
            margin-left: -20px;
            margin-right: -20px;
            margin-bottom: 20px;
        }
        .rights {
            font-size: 12px;
            color: #aaa;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-bar"></div>



        <h1>New Booking Alert!</h1>

        <p class="intro">Dear {{ $counsellor->full_name_with_rate }}, a new client has booked a session. Here are the details:</p>

        <div class="details">
            <p><strong>Client Name:</strong> {{ $formDetails['name'] ?? 'N/A' }}</p>
            <p><strong>Mobile Number:</strong> {{ $formDetails['mobile_no'] }}</p>
            <p><strong>Email:</strong> {{ $formDetails['email'] }}</p>
            <p><strong>Faculty:</strong> {{ $formDetails['faculty'] }}</p>
            <p><strong>Timeslot:</strong> {{ $timeslot->time }}</p>
        </div>

        <p class="footer">Please review the details above and prepare for your session. We wish you a productive meeting!</p>

        <a href="{{ url('/counsellor/dashboard') }}" class="button">Go to Dashboard</a>

        <!-- Rights Reserved Section -->
        <p class="rights">Sitharana Psychological Counseling Center © 2024, Sabaragamuwa University of Sri Lanka. All rights reserved.</p>
    </div>
</body>
</html>
