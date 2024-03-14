<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="logo-container">
                <img src="{{ asset('media/images/cloudstaff-logo-share.png') }}" alt="CloudStaff Logo" class="logo">
            </div>
            <h2>Employee Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                </div>

                <button type="submit">Login</button>

                @error('email')
                    <div class="error-container">
                        <div class="error-message">{{ $message }}</div>
                    </div>
                @enderror

                @error('password')
                    <div class="error-container">
                        <div class="error-message">{{ $message }}</div>
                    </div>
                @enderror
            </form>
        </div>
    </div>
</body>
</html>
