<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html>
