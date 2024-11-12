@extends('layout')

@section('title', 'Sith Arana | Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

@section('content')

<style>
    .slider{
        position: absolute;
        top: 80px;
        z-index: -1000;
    }
    .box{
        background-color: rgba(129, 9, 148, 0.221);
    }
    .box1{
        background-color: rgba(255, 255, 255, 0.536);
        padding: 15px 5px;
        border-radius: 24px;
    }
    .box2{
        z-index: 100;
    }
    .tags-container p{
        background-color: rgba(29, 128, 221, 0.518);
        color: white;

    }
    @media (max-width: 1200px) {

        .slider {

            display: none;
        }

    }
    @media (max-width: 800px) {


    }
    .animated-heading {
    display: none; /* Hide all headings initially */
}
.testimonial-text {
    font-size: 2em;
    margin: 20px 0;
}

.testimonial-name {
    font-weight: bold;
    color: #555;
    text-align: right;
    font-size: 1em;
    margin-top: 10px;
    font-size: 18px;
}



</style>


    {{-- ======================hero section====================== --}}
<div class="outer-container hero-container box">
    <div class="main-container hero-content-container box1" data-aos="fade-up">
        <div class="tags-container">
            <p class="tags">10+ Specialist</p>
            <p class="tags">50min sessions</p>
            <p class="tags">Free of charge</p>
        </div>
        <div class="hero-desc-container">
            <h1>Your Feelings Matter, <span class="text-gradient">Let's Talk</span></h1>
            <p>Book a session with a qualified Counsellor easily and quickly...</p>
        </div>
        <a href="{{ route('counsellors.index') }}"><button class="btn-gradient btn-cta">Book a Session</button></a>
    </div>
</div>

{{-- ======================emergency call section====================== --}}
<div class="outer-container emergency-call-container box2">
    <div class="hero-img-container">
        <img src="{{ asset('images/hero-1.png') }}" alt="Counsellor Image 1">
        <img src="{{ asset('images/hero-2.png') }}" alt="Counsellor Image 2">
    </div>
    <p class="main-container">For any urgent needs, please contact: +945783234 | +9458324321 | +9478843457</p>
</div>
<div id="carouselExampleSlidesOnly" class="carousel slide slider" data-ride="carousel">

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('images/slide_1.jpg')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('images/slide_2.jpg')}}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('images/slide_3.jpg')}}" alt="Third slide">
    </div>
  </div>


</div>



    {{-- ===============quick appoinment section================= --}}
    {{--  <div class="outer-container">
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
    </div>  --}}
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
    <div class="outer-container " style="margin: 100px 10px;">
    <div class="main-container testimonial-container">
        <h3 class="testimonial-title">What our students are saying...</h3>
        <div class="testimonial-slider" id="testimonial-slider">
            <button class="prev" onclick="moveSlide(-1)"><img src="images/left-arrow.svg" alt="Previous"></button>
            <div class="testimonial-content" id="testimonial-content">
                <!-- Testimonials will be dynamically injected here -->
            </div>
            <button class="next" onclick="moveSlide(1)"><img src="images/right-arrow.svg" alt="Next"></button>
        </div>
    </div>
</div>
    {{-- ==============testimonial section================ --}}

    {{-- ==============contact us section================ --}}
    <div class="outer-container">
        <div class="main-container contact-home-content-container">
            <div class="contact-title-wrapper">
                <h2 class="section-title">Send  <span class="text-gradient">Your Feedback</span></h2>
                <p class="section-sub-title">Send any thing you need us to hear</p>
            </div>
            <div class="contact-img-wrapper">
                <img src="{{ asset('images/contact-img.png') }}" alt="">
            </div>
            <form action="{{ route('feedback.store') }}" method="POST" class="contact-home-form">
            @csrf
    <input type="text" name="name" placeholder="Your name (Optional)">
    <input type="email" name="email" placeholder="Your email (Optional)">
    <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your message.." required></textarea>
    <button type="submit" class="btn-gradient btn-submit">Submit</button>
            </form>
        </div>
        {{-- ==============contact us section================ --}}
<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header text-center" style="background-color: #941b9a; color: white; display: flex; justify-content: center;">
                <h5 class="modal-title w-100" id="thankYouModalLabel" style="font-weight: bold; font-size: 2em;">🎉 Thank You!</h5>
            </div>
            <div class="modal-body text-center" style="padding: 30px; font-size: 2em; color: #444;">
                <p style="margin: 0; font-weight: 500;">
                    Thank you for your feedback!<br>We appreciate your input and support.
                </p>
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn btn-primary px-4 py-2" style="background-color: #8d1b9a; border-color: #6a1b9a;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery, Popper.js, and Bootstrap JS -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></scrip>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
            myModal.show();
        });
    </script>
@endif
<script>

  const testimonials = @json($testimonials);

    let currentSlide = 0;

    function displayTestimonial(slideIndex) {
        const testimonialContent = document.getElementById("testimonial-content");
        const { message: text, name } = testimonials[slideIndex];
        testimonialContent.innerHTML = `
            <p class="testimonial-text">"${text}"</p>
            <p class="testimonial-name">- ${name}</p>
        `;
    }

    function moveSlide(step) {
        currentSlide = (currentSlide + step + testimonials.length) % testimonials.length;
        displayTestimonial(currentSlide);
    }

    // Initialize the first testimonial
    displayTestimonial(currentSlide);

    // Auto-slide every 5 seconds
    setInterval(() => moveSlide(1), 5000);
</script>
   @endsection
