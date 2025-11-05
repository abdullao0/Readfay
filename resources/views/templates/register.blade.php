@extends('templates.base')

@section('title','Register')

@section('content')

<div class="auth-container">
    <div class="auth-card">
        <h2>Create Account</h2>
        <div class="auth">
        </div>
        <form method="POST" action="register" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="username">First Name</label>
                <input type="text" id="username" name="first_name" required class="form-input" value="{{ old('first_name') }}">
                @error('name')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Last Name</label>
                <input type="text" id="username" name="last_name" required class="form-input" value="{{ old('last_name') }}">
                @error('name')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>

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
                <input type="password" id="" name="password" required class="form-input" value="{{ old('password') }}">
                <label for="password">Confirem Password</label>
                <input type="password" id="" name="password_confirmation" required class="form-input" value="{{ old('password_confirmation') }}">
                @error('password')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button onclick="style.display = 'none' " type="submit" class="btn btn-primary btn-full">Create Account</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</div>


@endsection