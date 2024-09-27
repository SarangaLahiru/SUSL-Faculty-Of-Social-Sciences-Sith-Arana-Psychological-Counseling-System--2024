<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust path as needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://source.unsplash.com/1600x900/?office,tech'); /* Example background */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            font-family: 'Arial', sans-serif;
        }

        .login-overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .login-container {
            z-index: 1;
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 50px;
            padding: 15px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
            border-radius: 50px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
            border-color: #0056b3;
        }

        .alert-danger {
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.9rem;
            color: #dc3545;
            text-align: left;
        }

        @media(max-width: 576px) {
            .login-container {
                padding: 20px;
            }
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
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
