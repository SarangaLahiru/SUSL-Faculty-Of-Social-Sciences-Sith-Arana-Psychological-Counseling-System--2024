@extends('layout')

@section('title', 'Sith Arana | Contact us')

@section('content')

    <h1 class="text-center text-6xl font-bold my-5">Contact Us</h1>

    <p class="text-center mb-8">Feel free to contact us by filling out the form below.</p>

    <div class="container mx-auto p-5 shadow-lg">
        <div class="row">
            <!-- Left side: Contact Form -->
            <div class="col-md-6 mb-4">
                <form action="/submit-contact" method="POST">
                    @csrf
                    <div class="row">
                        <!-- First Name -->
                        <div class="form-group col-md-6 mb-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Last Name -->
                        <div class="form-group col-md-6 mb-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div class="form-group mb-4">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="form-group mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-full sm:w-auto px-4 py-2 bg-purple-500 hover:bg-purple-700 text-white font-bold rounded">Send Message</button>
                    </div>
                </form>
            </div>

            <!-- Right side: Image -->
            <div class="col-md-6 text-center">
                <img src="/images/contact-img.png" alt="Contact Image" class="w-full h-auto rounded-lg shadow-md">
            </div>
        </div>
    </div>

@endsection

<style>
    .container {
        background-color: white;
        border-radius: 0.5rem;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
    }

    .form-control:focus {
        border-color: #fa30ce;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-primary {
        transition: background-color 0.3s;
    }
</style>
