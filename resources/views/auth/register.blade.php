@extends('layouts.app')

@section("style")
<link rel="stylesheet" href="/css/register-and-login.css">
@endsection

@section('content')
<div class="content">
    <h1>Register</h1>
    <p class="description">Register to write and publish guides!</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-and-info-container">
            <label for="name">Name</label>
            <input id="name" type="text" class="text-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <strong>{{ $message }}</strong>
            @enderror
            @error("slug")
                <strong>{{ $message }}</strong>
            @enderror
        </div>

        <div class="input-and-info-container">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" class="text-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                    <strong class="error">{{ $message }}</strong>
            @enderror
        </div>

        <div class="input-and-info-container">
            <label for="password" >Password</label>
            <input id="password" type="password" class="text-input" name="password" required autocomplete="current-password">
            @error('password')
                <strong class="error">{{ $message }}</strong>
            @enderror
        </div>
        
        <div class="input-and-info-container">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <input type="submit" class="login-register-button" value="Register">
    </form>
</div>
@endsection
