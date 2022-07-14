@extends('layouts.app')

@section('content')
<div class="content">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">E-Mail Address</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <br>

        @error('email')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>

        <label for="password" >Password</label>
        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <br>

        @error('password')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>
        
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Remember Me</label>
        <br>

        <button type="submit">
            {{ __('Login') }}
        </button>
        <br>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
        @endif
    </form>
</div>
@endsection
