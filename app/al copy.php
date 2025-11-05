@extends('templates.base')

@section('title','Profile')

@section('content')

@php
    $progress = $progress ?? collect();
@endphp
@if (session('error'))
    <div style="color: red;">
        <h1>{{ session('error') }}</h1>
        
    </div>
@endif

<div class="container">
    <div class="profile-container">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <img src="{{ asset('/storage/' . ($profile->image ?? 'defaults/default.png')) }}" 
                 alt="Profile image"
                 class="profile-img"
                 style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #5BA8A8; margin-bottom: 1rem;">
            <h2 style="color: #3A6B6B; margin-bottom: 0.5rem;">{{ $profile->user->first_name ?? ''}} {{ $profile->user->last_name ?? '' }}</h2>
            <p class="profile-bio" style="color: #666; margin-bottom: 1.5rem;">{{ $profile->bio ?? 'No bio yet.' }}</p>
        </div>

        <div class="profile-info" style="text-align: center; margin-bottom: 1.5rem;">
            <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> {{ $profile->user->email ?? 'Hidden' }}</p>
            <a href="{{ route('updateProfile',$profile->user_id) ?? "/index" }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>

    <div style="max-width: 1000px; margin: 2rem auto;">
        <table class="progress-table">
            <thead>
                <tr>
                    <th>Passage Title</th>
                    <th>WPM</th>
                    <th>Duration</th>
                    <th>Test Score</th>
                </tr>
            </thead>
            <tbody>
                @forelse($progress as $p)
                    <tr>
                        <td>{{ $p->passage->title }}</td>
                        <td>{{ $p->WPM ?? '—' }}</td>
                        <td>
                            @if($p->Duration)
                                @php
                                    $duration = $p->Duration;
                                    $totalSeconds = 0;
                                    
                                    if($duration instanceof \Carbon\Carbon) {
                                        $totalSeconds = $duration->hour * 3600 + $duration->minute * 60 + $duration->second;
                                    } elseif(is_string($duration)) {
                                        $parts = explode(':', $duration);
                                        if(count($parts) >= 3) {
                                            $totalSeconds = (int)$parts[0] * 3600 + (int)$parts[1] * 60 + (int)$parts[2];
                                        } elseif(count($parts) == 2) {
                                            $totalSeconds = (int)$parts[0] * 60 + (int)$parts[1];
                                        }
                                    }
                                    
                                    $minutes = floor($totalSeconds / 60);
                                    $seconds = $totalSeconds % 60;
                                @endphp
                                {{ $minutes }} min {{ $seconds }} sec
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $p->TestScore }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No progress records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin: 2rem 0;">
        <form action="/logout" method="post" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-secondary" style="padding: 0.75rem 2rem;">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection