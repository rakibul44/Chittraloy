@extends('layouts.main')

@section('title', 'Gallery — Chittraloy')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/gallery.css') }}"/>
@endsection

@section('content')
<!-- ══════════════ HERO ════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-decor" aria-hidden="true">Gallery</div>
    <div class="hero-content">
        <p class="hero-eyebrow">Our Visual Stories</p>
        <h1 class="hero-title">Every Frame<br>a <em>Love Story</em></h1>
        <p class="hero-sub">Timeless Wedding Photography by Our Team</p>
        <div class="hero-line" aria-hidden="true"></div>
    </div>
</section>

<!-- ══════════════ MARQUEE ════════════════════════════ -->
<div class="featured-strip" aria-hidden="true">
    <div class="strip-inner" id="marquee">
        <span class="strip-item">Golden Hour Portraits</span>
        <span class="strip-item">Candid Emotions</span>
        <span class="strip-item">Ceremony Moments</span>
        <span class="strip-item">Reception Highlights</span>
        <span class="strip-item">Bridal Preparations</span>
        <span class="strip-item">Couple Sessions</span>
        <span class="strip-item">Details &amp; Décor</span>
        <span class="strip-item">Destination Weddings</span>
    </div>
</div>

<!-- ══════════════ FILTER + GALLERY ══════════════════ -->
<section class="filter-section" id="gallery">
    <div class="container-fluid">
        <div class="reveal text-center-sm text-center">
            <p class="section-eyebrow">Portfolio</p>
            <h2 class="section-title">Our <em>Gallery</em></h2>
            <div class="gold-line"></div>
        </div>
        <div class="filter-bar reveal" id="filterBar" role="group" aria-label="Filter photos">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="ceremony">Ceremony</button>
            <button class="filter-btn" data-filter="portrait">Portraits</button>
            <button class="filter-btn" data-filter="reception">Reception</button>
            <button class="filter-btn" data-filter="bridal">Bridal</button>
            <button class="filter-btn" data-filter="details">Details</button>
        </div>
    </div>
</section>

<section class="gallery-section" aria-label="Photo gallery">
    <div class="gallery-grid" id="galleryGrid"></div>
    <button class="load-more-btn" id="loadMore">Load More Memories</button>
</section>

<!-- ══════════════ STATS ══════════════════════════════ -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3 reveal">
                <div class="stat-num" data-count="480">0</div>
                <div class="stat-label">Weddings Captured</div>
            </div>
            <div class="col-6 col-md-3 reveal">
                <div class="stat-num" data-count="12">0</div>
                <div class="stat-label">Years of Experience</div>
            </div>
            <div class="col-6 col-md-3 reveal">
                <div class="stat-num" data-count="8">0</div>
                <div class="stat-label">Team Photographers</div>
            </div>
            <div class="col-6 col-md-3 reveal">
                <div class="stat-num" data-count="34">0</div>
                <div class="stat-label">Awards Won</div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        window.serverPhotos = @json($galleries);
    </script>
    <script src="{{ asset('assets/js/gallery.js') }}"></script>
@endsection
