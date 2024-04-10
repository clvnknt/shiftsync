<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: auto;
            background-color: #0071F8;
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body>

@if(auth()->check() && !in_array(request()->route()->getName(), ['login', 'landing']))
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('media/images/staffcentral-login-logo.png') }}" alt="StaffCentral Logo" class="img-fluid me-2" style="max-height: 40px;">
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                @auth
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('inout') }}">In/Out</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('timesheet') }}">Timesheet</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">File Ticket</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                    </ul>
                    <div class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->employeeRecord->employee_profile_picture ? asset('storage/' . Auth::user()->employeeRecord->employee_profile_picture) : asset('media/images/icons/inout/EmployeeDefault.png') }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
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
            <span>&copy; {{ date('Y') }} StaffCentral</span>
        </div>
    </footer>
@endif

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
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
