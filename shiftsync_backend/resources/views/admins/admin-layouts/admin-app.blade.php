<!-- resources/views/layouts/admin-app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        #content {
            flex: 1 1 auto;
            padding: 2rem;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="d-flex flex-fill">
        <!-- Sidebar -->
        @include('admins.admin-layouts.partials.sidebar')

        <!-- Page Content -->
        <div id="content" class="w-100 flex-fill">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('admins.admin-layouts.partials.footer')

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>