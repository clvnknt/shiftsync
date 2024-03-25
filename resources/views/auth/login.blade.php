<form method="POST" action="{{ route('login') }}" class="login-form">
    @csrf
    <div class="form-group">
        <label for="email_or_username">Email or Username</label>
        <input id="email_or_username" type="text" name="email_or_username" value="{{ old('email_or_username') }}" required autofocus placeholder="Enter your email or username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
    </div>

    <button type="submit" class="btn-login">Login</button>

    @error('email_or_username')
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
