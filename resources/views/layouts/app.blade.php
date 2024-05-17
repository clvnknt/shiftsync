<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #333333;
            color: #FFFFFF; /* Ensure all text is white */
        }

        .footer {
            margin-top: auto;
            background-color: #484848; /* Dark Gray footer */
            color: #FFFFFF; /* White text for footer */
        }

        .navbar {
            background-color: #484848 !important; /* Dark Gray navbar */
            color: #FFFFFF; /* White text for navbar */
        }

        .navbar .nav-link, .navbar .navbar-brand, .navbar .dropdown-item {
            color: #FFFFFF !important; /* Ensure navbar links and items are white */
        }

        .navbar .dropdown-menu {
            background-color: #484848; /* Dark Gray dropdown menu */
        }

        .navbar .dropdown-item:hover {
            background-color: #575757; /* Slightly lighter gray on hover */
        }

        .modal-content {
            background-color: #484848; /* Dark Gray background for modal */
            color: #FFFFFF; /* White text for modal */
        }

        /* Center modal */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100% - 1rem);
        }
    </style>
    @yield('styles')
</head>
<body>

@if(auth()->check() && !in_array(request()->route()->getName(), ['login', 'landing']))
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('media/images/logos/L-SS-WB.png') }}" alt="ShiftSync Logo" class="img-fluid me-2" style="max-height: 40px;">
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                @auth
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('inout') }}">In/Out</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('timesheet') }}">Timesheet</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('myAccount') }}">My Account</a></li>
                    </ul>
                    <div class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->employeeRecord->employee_profile_picture ? asset('storage/' . Auth::user()->employeeRecord->employee_profile_picture) : asset('media/images/icons/DP.png') }}" alt="Profile Picture" style="max-width: 40px; max-height: 40px;">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" id="logout-link">Logout</a></li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>
@endif

@yield('content')

@if(auth()->check() && !in_array(request()->route()->getName(), ['login', 'landing']))
    <footer class="footer py-3 text-center">
        <div class="container">
            <span>&copy; {{ date('Y') }} ShiftSync</span>
        </div>
    </footer>
@endif

@auth
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endauth

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        $('#logoutModal').modal('show');
    });
</script>
@yield('scripts')
</body>
</html>