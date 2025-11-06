
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title','base')</title>
    
</head>

@php
    $user_id = Auth::id();
@endphp
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">
                    <a href="/index" >Readfay</a>
                </h1>
                @if ($user_id)
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="/index" class="nav-link">Home</a></li>
                        <li><a href="{{ route('profile.get',$user_id) }}"  class="nav-link">Profile</a></li>                  
                    </ul>
                </nav>
                @else
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="/index" class="nav-link">Home</a></li>
                        <li><a href="{{ route('login') }}" class="nav-link">Profile</a></li>                  
                        <li><a href="/login" class="nav-link">Login</a></li>
                    </ul>
                </nav>
                @endif

            </div>
        </div>
    </header>

    <main class="main">
    <div>
        @yield('content','this is the base page')   
    </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; Readfay.</p>
        </div>
    </footer>
</body>

</html>