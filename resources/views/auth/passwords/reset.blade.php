<!-- resources/views/auth/passwords/reset.blade.php -->

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required class="form-control">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __('Reset Password') }}
    </button>
</form>
