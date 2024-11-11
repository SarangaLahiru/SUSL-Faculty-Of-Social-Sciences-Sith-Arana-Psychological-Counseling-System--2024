
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        h1 { color: #74148c; text-align: center; }
        .details { margin: 20px 0; }
        .details p { font-size: 16px; line-height: 1.6; }
        .field-label { font-weight: bold; color: #74148c; }
        .footer { text-align: center; margin-top: 30px; font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>

        <div class="details">
            <p><span class="field-label">Counsellor Name:</span> {{ $counsellor->name }}</p>
            <p><span class="field-label">Session Time:</span> {{ $timeslot->time }}</p>
            <p><span class="field-label">Location:</span> {{ $location }}</p>
        </div>

        <div class="details">
            <p><span class="field-label">Client Name:</span> {{ $formDetails['name'] }}</p>
            <p><span class="field-label">Email:</span> {{ $formDetails['email'] }}</p>
            <p><span class="field-label">Phone:</span> {{ $formDetails['mobile_no'] }}</p>
            <p><span class="field-label">Faculty:</span> {{ $formDetails['faculty'] }}</p>
        </div>

        <div class="footer">
            <p>Sitharana Psychological Counseling Center © 2024, Sabaragamuwa University of Sri Lanka. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
