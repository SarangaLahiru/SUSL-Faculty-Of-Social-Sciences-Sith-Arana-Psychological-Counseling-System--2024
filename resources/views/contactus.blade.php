@extends('layout')

@section('title', 'Sith Arana | Contact us')

@section('content')

<h1 class="contact-title text-center my-5">Contact Us</h1>

<p class="contact-subtitle text-left mb-8">Feel free to contact us by filling out the form below.</p>

<div class="container mx-auto p-5 shadow-lg">
    <div class="row align-items-center">
        <!-- Left side: Contact Information -->
        <div class="col-md-6 mb-4">
            <div class="contact-info p-4 rounded">
                <div class="card text-center shadow-sm p-4 rounded mb-4" style="width: 100%;">
                   
                    <h5 class="card-title">Email Us</h5>
                    <p class="card-text">infocounsellor@gmail.com</p>
                </div>
                <div class="card text-center shadow-sm p-4 rounded mb-4" style="width: 100%;">
                    <h5 class="card-title">Call Us</h5>
                    <p class="card-text">+94 75965738</p>
                </div>
                <div class="card text-center shadow-sm p-4 rounded" style="width: 100%;">
                    <h5 class="card-title">Location</h5>
                    <p class="card-text">Sabaragamuwa University of Sri Lanka</p>
                </div>
            </div>
        </div>

        <!-- Right side: Image -->
        <div class="col-md-6 text-center">
            <img src="/images/contact-img.png" alt="Contact Image" class="w-100 h-auto rounded-lg shadow-md">
        </div>
    </div>
</div>

@endsection

<style>
.contact-title {
    font-size: 6rem;
}

.contact-subtitle {
    font-size: 2rem;
    margin-left: 10rem;
    color: #5a5858;
}

.container {
    background-color: white;
    border-radius: 0.5rem;
}

/* Card styles */
.card {
    width: 90%; 
    max-width: 400px; 
    margin: 0 auto; 
    font-size: 1.2rem; 
}

.card-title {
    font-size: 1.5rem; 
    color: #333333; 
}

.card-text {
    font-size: 1.2rem; 
    color: #666666; 
}




</style>
