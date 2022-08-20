@extends('layouts.app')

@section("style")
<link rel="stylesheet" href="/css/register-and-login.css">
@endsection

@section('content')
<div class="content">
    <h1>Login</h1>
    <p>Login to write and publish guides!</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @error('email')
                <strong class="error">{{ $message }}</strong>
        @enderror
        
        <div class="input-and-info-container">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" class="text-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        
        <div class="input-and-info-container">
            <label for="password" >Password</label>
            <input id="password" type="password" class="text-input" name="password" required autocomplete="current-password">
            @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
            @endif
        </div>
        
        
        <input class="remember-me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="remember-me" for="remember">Remember Me</label>
        <br>
        
        <input class="login-register-button" type="submit" value="Login">
        <p class="no-user-text">Don't have a user yet?</p>
        <a class="login-register-button" style="background: var(--accent-color-2) !important" href="{{ route('register') }}">Register</a>
        
    </form>
</div>
@endsection
