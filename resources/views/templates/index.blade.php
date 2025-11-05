@extends('templates.base')

@section('title','home')

@section('content')


@if (session('error'))
    <div style="color: red;">
        <h1>{{ session('error') }}</h1>
        
    </div>
@endif
@if (session('ok'))
    <div style="color: green;">
        <h1>{{ session('ok') }}</h1>
        
    </div>
@endif

@php
    $passages = $passages ?? collect();
@endphp

<section class="hero">
    <div class="hero-content">
    <h2>Track. Train. Read Faster.</h2>
    <p>Readfay helps you analyze your reading speed and improve your comprehension with every session.</p>
    </div>
</section>
<section class="titles-section">
    <div class="section-header">
        <h2>All Passages</h2>
    </div>

    <div class="passages-container">
        @forelse($passages as $index => $passage)
        <article class="passage-card" style="background: {{ $index % 3 == 0 ? 'linear-gradient(135deg, #7FB3B3 0%, #5BA8A8 100%)' : ($index % 3 == 1 ? 'linear-gradient(135deg, #D4A574 0%, #C8956B 100%)' : 'linear-gradient(135deg, #7DB3D3 0%, #6BA3C4 100%)') }};">
            <div class="passage-card-inner">
                <h3 class="passage-title">
                    <a href="{{ route('show.passage',$passage->id) }}">{{$passage->title }}</a>
                </h3>
                <div class="passage-details">
                    <div class="passage-detail-item">
                        <span class="detail-label">Difficulty</span>
                        <span class="detail-value">{{ $passage->difficultyLevel }}</span>
                    </div>
                    <div class="passage-detail-item">
                        <span class="detail-label">Words</span>
                        <span class="detail-value">{{$passage->numberOfWords}}</span>
                    </div>
                </div>
                <a href="{{ route('show.passage',$passage->id) }}" class="passage-read-btn">Start Reading →</a>
            </div>
        </article>
        @empty
        <div class="empty-passages">
            <p>No Passages available. Please check back later!</p>
        </div>
        @endforelse
    </div>
</section>
@endsection


