@extends('layout')

@section('title', 'Sith Arana | About Us')

@section('content')
<!-- About Us Header -->
<section class="about-us-header" data-aos="fade-up" style="background-color: #F0F0F0; padding: 40px 0; text-align: center;">
    <h1 style="color: #4A4A4A; font-size: 36px;">About Sith Arana</h1>
    <p style="color: #6A6A6A; font-size: 18px;">Our mission is to support and improve mental health and well-being.</p>
</section>

<!-- Our Story Section -->
<section class="our-story" data-aos="fade-up" style="padding: 60px 0; text-align: center;">
    <div class="container">
        <h2 style="color: #4A4A4A; font-size: 30px;">Our Story</h2>
        <p style="color: #6A6A6A; font-size: 16px; max-width: 800px; margin: 0 auto;">
            At Sith Arana, we are dedicated to offering professional and compassionate counseling services to individuals in need. We believe in fostering a supportive community where everyone can access mental health resources and find a safe space to discuss their feelings and challenges.
        </p>
    </div>
</section>

<!-- Our Mission Section -->
<section class="our-mission" data-aos="fade-up" style="background-color: #E5E5E5; padding: 60px 0; text-align: center;">
    <div class="container">
        <h2 style="color: #4A4A4A; font-size: 30px;">Our Mission</h2>
        <p style="color: #6A6A6A; font-size: 16px; max-width: 800px; margin: 0 auto;">
            Our mission is to provide accessible and affordable mental health support, helping individuals navigate life’s challenges and improve their well-being. We strive to make counseling services available to everyone, regardless of their circumstances.
        </p>
    </div>
</section>

<!-- Meet the Team Section -->
<section class="meet-the-team" data-aos="fade-up" style="padding: 60px 0;">
    <div class="container">
        <h2 style="color: #4A4A4A; font-size: 30px; text-align: center;">Meet Our Counselors</h2>
        <div class="team-grid" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">

            <!-- Team Member 1 -->
            <div class="team-member" style="text-align: center;">
                <img src="path_to_counselor_image" alt="Counselor 1" style="border-radius: 50%; width: 150px; height: 150px;">
                <h4 style="color: #4A4A4A;">Dr. Alexander Matthews</h4>
                <p style="color: #6A6A6A;">Lead Counselor</p>
            </div>

            <!-- Team Member 2 -->
            <div class="team-member" style="text-align: center;">
                <img src="path_to_counselor_image" alt="Counselor 2" style="border-radius: 50%; width: 150px; height: 150px;">
                <h4 style="color: #4A4A4A;">Dr. Samantha Lee</h4>
                <p style="color: #6A6A6A;">Mental Health Specialist</p>
            </div>

            <!-- Team Member 3 -->
            <div class="team-member" style="text-align: center;">
                <img src="path_to_counselor_image" alt="Counselor 3" style="border-radius: 50%; width: 150px; height: 150px;">
                <h4 style="color: #4A4A4A;">Dr. Johnathan Green</h4>
                <p style="color: #6A6A6A;">Therapist</p>
            </div>
        </div>
    </div>
</section>



@endsection
