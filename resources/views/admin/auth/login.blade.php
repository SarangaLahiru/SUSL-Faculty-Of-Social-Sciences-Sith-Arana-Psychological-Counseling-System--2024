<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust path as needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS for styling -->
    <style>
        /* Background overlay */
        .login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f5f3f0;
            background-size: cover;
            z-index: -1;
        }

        /* Centered login container */
        .login-container {
            max-width: 400px;
            margin: 140px auto;
            padding: 30px;
            background-color: #f5f3f0;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Login form styling */
        .login-container h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #622864; /* Primary color */
        }

        .form-group input {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .form-group input:focus {
            background-color: #fff;
            border-color: #622864;
        }

        .form-group .invalid-feedback {
            font-size: 0.9rem;
            color: #ff6b6b;
        }

        /* Button styling */
        .btn-primary {
            background-color: #622864;
            border: none;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Alert message styling */
        .alert {
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-overlay"></div>

    <div class="login-container">
        <h1>Admin Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <!-- Email Input -->
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
