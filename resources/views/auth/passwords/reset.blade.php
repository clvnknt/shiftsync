<!-- resources/views/auth/passwords/reset.blade.php -->

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">
        {{ __('Reset Password') }}
    </button>
</form>
