<!DOCTYPE html>
<html>
<head>
    <title>Your Account Details</title>
</head>
<body>
    <h1>Hello, {{ $email }}</h1>
    <p>Welcome to the counselling system. Your account has been created successfully.</p>
    {{--  <p><strong>Username:</strong> {{ $NIC }}</p>  --}}
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>Please log in and change your password after your first login for security reasons.</p>
    <p>Best regards,<br>The Counselling Team</p>
</body>
</html>
