<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .footer {
            margin-top: auto;
            background-color: #0071F8;
            color: white;
        }
    </style>
    @yield('styles') <!-- Additional styles specific to each page -->
</head>

@if (!auth()->check() && !request()->is('login'))
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif

<body>
    
<!-- Navbar -->
@unless(request()->is('login')) <!-- Hide navbar on login page -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border border-dark">
    <div class="container">
        <a class="navbar-brand" href="/">IAOS</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inout') }}">In/Out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('timesheet') }}">Timesheet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">File Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
            </ul>
            <span class="navbar-text me-3 text-black">
                @auth
                    Welcome, {{ auth()->user()->name }}
                @endauth
            </span>
            @auth
                <!-- Logout Modal Trigger Button -->
                <button type="button" class="btn btn-link nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Logout
                </button>
            @endauth
        </div>
    </div>
</nav>
@endunless

<!-- Logout Modal -->
@auth
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

    <!-- Page content -->
    @yield('content')

    <!-- Footer -->
    @unless(request()->is('login')) <!-- Hide footer on login page -->
    <footer class="footer py-3 text-center">
        <div class="container">
            <span>&copy; {{ date('Y') }} IAOS</span>
        </div>
    </footer>
    @endunless

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    @yield('scripts') <!-- Additional scripts specific to each page -->
</body>
</html>
