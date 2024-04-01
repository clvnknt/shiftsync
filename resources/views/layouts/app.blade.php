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
            <div class="d-flex align-items-center">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <a class="nav-link" href="#">Help</a>
                    </li>
                </ul>
                <div class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->employeeRecord->employee_profile_picture ? asset('storage/' . Auth::user()->employeeRecord->employee_profile_picture) : asset('media/images/icons/inout/EmployeeDefault.png') }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
                        Welcome, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <!-- Add an ID to the logout link for JavaScript reference -->
                            <a class="dropdown-item" href="#" id="logout-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
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
                <!-- Add an onclick event to trigger the logout action -->
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
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

    <!-- Logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        // Add click event listener to the logout link
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            $('#logoutModal').modal('show'); // Show the logout confirmation modal
        });
    </script>
    @yield('scripts') <!-- Additional scripts specific to each page -->
</body>
</html>
