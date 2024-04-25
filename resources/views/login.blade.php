<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <style>
        .login-container {
            /* Remove or adjust the box-shadow property */
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="logo-container">
                <!-- Add your logo here -->
            </div>
            <h2>Employee Login</h2>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="identity">Email or Username</label>
                    <input id="identity" type="text" name="identity" value="{{ old('identity') }}" required autofocus placeholder="Enter your email or username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                </div>

                <button type="submit" class="btn-login">Login</button>

                @error('identity')
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
