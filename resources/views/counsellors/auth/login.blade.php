<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counsellor Login</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <!-- Custom CSS for styling -->
    <style>
        /* Background overlay */
        body {
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
            border-color: #0d6efd;
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
        <h1> Counsellor Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

                <form action="{{ route('counsellor.login') }}" method="post">
                    @csrf

                    <!-- NIC No -->
                    <div class="form-group">
                        <input type="text" name="NIC" id="username" class="form-control @error('NIC') is-invalid @enderror" value="{{ old('NIC') }}" placeholder="Enter NIC No" required>
                        @error('NIC')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>

            <!-- Session Confirmed Modal -->
            <div class="modal fade" id="sessionConfirmedModal" tabindex="-1" aria-labelledby="sessionConfirmedModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                        <div class="modal-header text-center" style="background-color: #28a745; color: white; display: flex; justify-content: center;">
                            <h5 class="modal-title w-100" id="sessionConfirmedModalLabel" style="font-weight: bold; font-size: 2em;">✅ Session Confirmed!</h5>
                        </div>
                        <div class="modal-body text-center" style="padding: 30px; font-size: 2em; color: #444;">
                            <p style="margin: 0; font-weight: 500;">
                                You have successfully confirmed the session for the client.
                            </p>
                        </div>
                        <div class="modal-footer d-flex justify-content-center" style="border-top: none; padding-bottom: 30px;">
                            <button type="button" class="btn btn-primary px-4 py-2" id="closeConfirm" style="background-color: #218838;" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Session Rejected Modal -->
            <div class="modal fade" id="sessionRejectedModal" tabindex="-1" aria-labelledby="sessionRejectedModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                        <div class="modal-header text-center" style="background-color: #dc3545; color: white; display: flex; justify-content: center;">
                            <h5 class="modal-title w-100" id="sessionRejectedModalLabel" style="font-weight: bold; font-size: 2em;">❌ Session Rejected!</h5>
                        </div>
                        <div class="modal-body text-center" style="padding: 30px; font-size: 2em; color: #444;">
                            <p style="margin: 0; font-weight: 500;">
                                You have successfully rejected the session request from the client.
                            </p>
                        </div>
                        <div class="modal-footer d-flex justify-content-center" style="border-top: none; padding-bottom: 30px;">
                            <button type="button" class="btn btn-primary px-4 py-2" id="closeReject" style="background-color: #c82333;" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize modals
        const confirmedModal = new bootstrap.Modal(document.getElementById('sessionConfirmedModal'));
        const rejectedModal = new bootstrap.Modal(document.getElementById('sessionRejectedModal'));

        // Show modals based on session
        @if(session('confirm'))
            confirmedModal.show();
        @endif



        @if(session('reject'))
            rejectedModal.show();
        @endif



        // Close button event listeners (optional)
        document.getElementById('closeConfirm')?.addEventListener('click', function () {
            confirmedModal.hide();
            console.log("Confirmed modal closed.");
        });

        document.getElementById('closeReject')?.addEventListener('click', function () {
            rejectedModal.hide();
            console.log("Rejected modal closed.");
        });
    });

</script>


</body>
</html>
