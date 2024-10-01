<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- boostrp css file links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    {{-- custom css file links --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bookingSession.css') }}">





    <title>@yield('title')</title>
</head>

<body>


    <header class="header-container">
        <div class="main-container nav-container ">
            <nav class="navbar">
                <div class="logo">
                    <p>SITH ARANA</p>
                </div>
                <ul>
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{ route('counsellors.index') }}">Counsellors</a></li>
                    <li><a href="{{ route('home.aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('home.contactus') }}">Contact Us</a></li>
                </ul>
                <div class="hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </nav>
            <div class="menubar">
                <ul>
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{ route('counsellors.index') }}">Counsellors</a></li>
                    <li><a href="{{ route('home.aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('home.contactus') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </header>


    <div>@yield('content')</div>


    <footer class="footer-container">
        <div class="main-container footer-content-container">
            <div class="container-contacts">
                <div class="email-wrapper">
                    <img src={{ asset('images/email-icon.svg') }} alt="">
                    <p>infocounsellor@gmail.com</p>
                </div>
                <div class="phone-wrapper">
                    <img src={{ asset('images/phone-icon.svg') }} alt="">
                    <p>+9475965738</p>
                </div>
            </div>

            <hr class="line">

            <nav class="footer">
                <ul class="footer-links-container">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{ route('counsellors.index') }}">Counsellors</a></li>
                    <li><a href="{{ route('home.aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('home.contactus') }}">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </footer>




    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/testimonial.js') }}"></script>



</body>

</html>
