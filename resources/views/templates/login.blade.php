@extends('templates.base')

@section('title','login')

@section('content')

@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif

<div class="auth-container">
    <div class="auth-card">
        <h2>Login to Readfay</h2>
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="username" name="email" required class="form-input" value="{{ old('email') }}">
                @error('email')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required class="form-input" value="{{ old('password') }}">
                @error('password')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button onclick="style.display = 'none' " type="submit" class="btn btn-primary btn-full">Login</button>
        </form>
        
        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</div>



@endsection