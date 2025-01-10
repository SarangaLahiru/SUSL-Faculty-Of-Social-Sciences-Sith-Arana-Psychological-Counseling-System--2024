<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://use.fontawesome.com/releases/v6.0.0/css/all.css' rel='stylesheet'>
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/bootstrap/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    {{-- boostrp css file links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">  --}}

    {{-- custom css file links --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bookingSession.css') }}">






    <title>@yield('title')</title>
</head>

<body>
    <style>
        /* General Styling */
        /* General Styling */


        .main-container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        .navbar {
            background-color: #7f3782;
            /* Your chosen navbar color */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: top 0.3s ease-in-out;
        }





        .nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-links li a {
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s ease;
        }

        /* Highlight for active page */
        .nav-links li a.active {
            color: #e5e5e5;
            /* Yellow color */
            font-weight: bold;
        }

        .nav-links li a.active::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #e5e5e5;
            /* Yellow underline */
            transform: scaleX(1);
            transition: transform 0.3s ease;
        }

        /* Underline animation for hover */
        .nav-links li a:not(.active):hover {
            color: #e5e5e5;
        }

        .nav-links li a:not(.active):hover::after {
            transform: scaleX(1);
        }

        /* Mobile Menu Styles */
        .logo img {
            height: 80px;
            /* Adjust height as needed */
            width: auto;
        }

        /* Loading Screen */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #fff;
            /* Background color for loading screen */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* Make sure it's above all other content */
        }

        .loading-logo {
            height: 200px;
            /* Adjust size as needed */
            width: auto;
            {{--  animation: spin 1.5s linear infinite;  --}}
        }

        /* Spin Animation */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .header-container {
            background-color: #7f3782;
            box-shadow: 0px 0px 10px black;
        }
    </style>


    <!-- Loading Screen -->
    <div id="loading-screen">
        <img src="{{ asset('images/logo1.gif') }}" alt="Loading..." class="loading-logo">
    </div>

    <header class="header-container">
        <div class="main-container nav-container">
            <nav class="navbar">
                <div class="logo">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('images/logos.png') }}" alt="SITH ARANA Logo" class="logo-image">
                    </a>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('home.index') }}" style="color: #e5e5e5"
                            class="{{ Route::is('home.index') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('counsellors.index') }}" style="color: #e5e5e5"
                            class="{{ Route::is('counsellors.index') ? 'active' : '' }}">Counsellors</a></li>
                    <li><a href="{{ route('home.aboutus') }}" style="color: #e5e5e5"
                            class="{{ Route::is('home.aboutus') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{ route('home.calendar') }}" style="color: #e5e5e5"
                            class="{{ Route::is('home.calendar') ? 'active' : '' }}">Calendar</a></li>

                    <li><a href="{{ route('home.contactus') }}" style="color: #e5e5e5"
                            class="{{ Route::is('home.contactus') ? 'active' : '' }}">Contact Us</a></li>

                </ul>
                <div class="hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </nav>
            <!-- Mobile Dropdown Menu -->
            <div class="menubar" id="mobileMenu">
                <ul>
                    <li><a href="{{ route('home.index') }}"
                            class="{{ Route::is('home.index') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('counsellors.index') }}"
                            class="{{ Route::is('counsellors.index') ? 'active' : '' }}">Counsellors</a></li>
                    <li><a href="{{ route('home.aboutus') }}"
                            class="{{ Route::is('home.aboutus') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{ route('home.calendar') }}"
                            class="{{ Route::is('home.calendar') ? 'active' : '' }}">Calendar</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div style="margin-top: 100px;">@yield('content')</div>


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

    <script>
        let lastScrollTop = 0;
        let navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > 100) { // Trigger only after scrollY > 100
                if (currentScroll > lastScrollTop) {
                    // Scroll Down - Hide Navbar
                    navbar.style.top = "-100px"; // Move navbar off-screen
                } else {
                    // Scroll Up - Show Navbar
                    navbar.style.top = "0"; // Reset navbar to top position
                }
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });
    </script>



    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/testimonial.js') }}"></script>
    <script>
        // Show loading screen on initial page load
        // Set a maximum display time for the loading screen
        const maxLoadingTime = 10000; // 10 seconds in milliseconds

        // Show loading screen on page refresh or close
        window.addEventListener('beforeunload', function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.display = 'flex';
            loadingScreen.style.opacity = '1';
        });

        // Hide loading screen either after page loads or after max time
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            // If the page loads within 10 seconds, hide the loading screen normally
            setTimeout(() => {
                loadingScreen.style.opacity = '0';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500); // Fade-out effect
            }, 300); // Adjust this delay as needed
        });

        // Hide the loading screen after the maximum loading time (10 seconds) if it’s still visible
        setTimeout(() => {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 500); // Fade-out effect
        }, maxLoadingTime);
    </script>
    <script>
        AOS.init();
    </script>




</body>

</html>
