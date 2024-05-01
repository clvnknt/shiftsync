<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div>
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">
        {{ __('Send Password Reset Link') }}
    </button>
</form>
