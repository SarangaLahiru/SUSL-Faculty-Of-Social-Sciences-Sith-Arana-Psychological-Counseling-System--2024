@extends('layout')

@section('title', 'Sith Arana | Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')

    {{-- ======================hero section====================== --}}
    <div class="outer-container hero-container">
        <div class="main-container hero-content-container">
            <div class="tags-container">
                <p class="tags">10+ Specialist</p>
                <p class="tags">50min sessions</p>
                <p class="tags">Free of charge</p>
            </div>
            <div class="hero-desc-container">
                <h1>Your Feeling Matter, <span class="text-gradient">Let's Talk</span></h1>
                <p>Book a sesssion with a qualified Counsellor easily and quickly...</p>
            </div>
            <a href="{{ route('counsellors.index') }}"><button class="btn-gradient btn-cta">Book a Session</button></a>

        </div>
    </div>
    {{-- ======================hero section====================== --}}

    {{-- ================emergency call section================== --}}
    <div class="outer-container emergency-call-container">
        <div class="hero-img-container">
            <img src="{{ asset('images/hero-1.png') }}" alt="">
            <img src="{{ asset('images/hero-2.png') }}" alt="">
        </div>
        <p class="main-container">For any urgent, please contact : +945783234 | +9458324321 | +9478843457</p>
    </div>
    {{-- ================emergency call section================== --}}

    {{-- ===============quick appoinment section================= --}}
    <div class="outer-container">
        <div class="main-container quick-appoinment-content-container">

            <div>
                <h2 class="section-title">Need a <span class="text-gradient">Session ASAP</span></h2>
                <p class="section-sub-title">Send any thing you need us to hear</p>
            </div>

            <div class="quick-appoinment-card-container">
                @foreach ($counsellors as $counsellor)
                    <div class="available-counsellor-card">
                        <div class="availabe-counsellor-profile-pic">
                            <img src="" alt="">
                        </div>
                        <div class="available-counsellor-details">
                            <h2>{{ $counsellor['full_name_with_rate'] }}</h2>
                            <p>{{ $counsellor['title'] }}</p>
                        </div>
                        <div class="available-counsellor-booking-wrapper">

                            <div class="next-available-session">
                                <h4>Next availabe</h4>
                                <p>Today 10.30am</p>
                            </div>

                            <div class="booking">
                                <h2>
                                    <a href="{{ route('counsellors.show', ['counsellor' => $counsellor['counsellor_id']]) }}">Book Now</a>
                                </h2>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    {{-- ===============quick appoinment section================= --}}

    {{-- ==============about our platform section================ --}}
    <div class="outer-container about-platform-container">
        <div class="about-platform-content-container">

            <h3 class="about-platform-title">About our platform</h3>

            <div class="dean-img-wrapper">
                <img src="{{ asset('images/dean-img.png') }}" alt="">
            </div>


            <div class="about-platform">
                <p class="about-platform-blockquote">“As the Dean of the faculty, I am impressed by the innovative
                    approach
                    our counseling booking platform
                    takes towards supporting student well-being.”
                    <br>
                    <br>
                    “By providing a space for open dialogue and personalized support, the platform fosters a culture of
                    holistic student development within our academic community. I believe that this resource not only
                    enhances student satisfaction and success but also reflects our commitment to nurturing the mental
                    health and resilience of our student body.”
                </p>

                <div>
                    <p class="dean-name">Dr. Alexander Matthews</p>
                    <p class="position">Faculty Dean</p>
                </div>

            </div>
        </div>
    </div>
    {{-- ==============about our platform section================ --}}

    {{-- ==============testimonial section================ --}}
    <div class="outer-container">
        <div class="main-container testimonial-container">
            <h3 class="testimonial-title">What our students are saying...</h3>
            <div class="testimonial-slider" id="testimonial-slider">
                <button class="prev" onclick="moveSlide(-1)"><img src="images/left-arrow.svg" alt="Previous"></button>
                <div class="testimonial-content" id="testimonial-content"></div>
                <button class="next" onclick="moveSlide(1)"><img src="images/right-arrow.svg" alt="Next"></button>
            </div>
        </div>
    </div>
    {{-- ==============testimonial section================ --}}

    {{-- ==============contact us section================ --}}
    <div class="outer-container">
        <div class="main-container contact-home-content-container">
            <div class="contact-title-wrapper">
                <h2 class="section-title">Contact <span class="text-gradient">Us</span></h2>
                <p class="section-sub-title">Send any thing you need us to hear</p>
            </div>
            <div class="contact-img-wrapper">
                <img src="{{ asset('images/contact-img.png') }}" alt="">
            </div>
            <form action="#" class="contact-home-form">
                <input type="text" placeholder="Your name(Optional)">
                <input type="email" placeholder="Your email(Optional)">
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your message.."></textarea>
                <button type="submit" class="btn-gradient btn-submit">Submit</button>
            </form>
        </div>
        {{-- ==============contact us section================ --}}


    @endsection
