<!DOCTYPE html>
<html>
<head>
    <title>Booking Cancellation</title>
</head>
<body>
    <p>Dear {{ $booking->name ?? 'User' }},</p>

    <p>We regret to inform you that your booking scheduled for {{ $booking->timeslot->date }} at {{ $booking->timeslot->time }} has been canceled.</p>

    <p>If you have any questions or need further assistance, please contact us.</p>

    <p>Best regards,<br>Your Company Name</p>
</body>
</html>
