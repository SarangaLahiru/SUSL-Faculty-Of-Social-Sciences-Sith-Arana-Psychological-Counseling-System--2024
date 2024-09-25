<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f3f0;
        }
        /* Custom styling for sidebar */
        .sidebar {
            height: 100vh;
            background-color: #f5f3f0;
        }
        .sidebar .nav-link {
            color: black;
            font-size: 16px;
            padding: 15px;
        }
        .sidebar .nav-link:hover {
            background-color: #6C3483;
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: #4A235A;
            font-weight: bold;
            color: white;
        }
        .navbar {
            background-color: #f5f3f0;
            height: 90px;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: relative;
                height: auto;
                padding: 15px;
            }
            .sidebar .nav-link {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LOGO</a>
            <div>
                <div class="dropdown">
                    <span class="me-2">Mr. John Doe</span>
                    <img src="https://via.placeholder.com/40" class="rounded-circle dropdown-toggle" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false" alt="Avatar">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                        <li><a class="dropdown-item" href="{{ route('counsellor.password.request') }}">Reset Password</a></li>
                        <li>
                            <form action="{{ route('counsellor.logout') }}" method="POST" class="d-inline">
                                @csrf <!-- Include CSRF token for security -->
                                <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar shadow">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('counsellor/dashboard') ? 'active' : '' }}" href="/counsellor/dashboard">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('counsellor/profile') ? 'active' : '' }}" href="/counsellor/profile">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('counsellor/availability') ? 'active' : '' }}" href="/counsellor/availability">
                                Availability
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
