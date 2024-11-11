<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4e148c;
            font-size: 24px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .account-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            border: 1px solid #dedede;
        }
        .account-details p {
            margin: 5px 0;
            font-weight: bold;
        }
        .highlight {
            color: #4e148c;
        }
        .footer {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Welcome, {{ $email }}!</h1>

        <p>We’re excited to welcome you to the counselling system. Your account has been created successfully, and you’re now just a step away from accessing personalized support.</p>

        <div class="account-details">
            {{--  <p><span class="highlight">Username:</span> {{ $NIC }}</p>    --}}
            <p><span class="highlight">Password:</span> {{ $password }}</p>
        </div>

        <p>For your security, we recommend logging in and updating your password as soon as possible.</p>

        <p>Thank you for trusting us to support your journey.</p>

        <p>Best regards,<br>The Counselling Team</p>

        <div class="footer">
            <p>If you have any questions, don’t hesitate to <a href="mailto:support@counsellingteam.com">contact us</a>.</p>
        </div>
    </div>
</body>
</html>
