@extends('layouts.main')

@section('content')
<!-- ══ HERO ══ -->
<section id="home" style="padding:0;">
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500">
  <div class="carousel-indicators">
    @foreach($heroes as $index => $hero)
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
    @endforeach
  </div>
  <div class="carousel-inner">
    @foreach($heroes as $index => $hero)
    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
      <div class="hero-slide" style="background-image: url('{{ $hero->bg }}');">
        <div class="hero-content">
          <span class="hero-tag">{{ $hero->tag }}</span>
          <h1 class="hero-title">{!! str_replace('|', '<br>', $hero->title) !!}</h1>
          <p class="hero-sub">{{ $hero->subtitle }}</p>
          <div class="hero-btns">
            @if($hero->btn1)
            <a href="#about" class="btn-hero">{{ $hero->btn1 }}</a>
            @endif
            @if($hero->btn2)
            <button class="btn-hero btn-hero-fill" data-bs-toggle="modal" data-bs-target="#bookingModal">{{ $hero->btn2 }}</button>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @if(count($heroes) > 1)
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
  @endif
  <div class="scroll-indicator"><div class="scroll-line"></div><span>Scroll</span></div>
</div>
</section>

<!-- ══ ABOUT ══ -->
<section id="about">
  <div class="container">
    <div class="row align-items-center g-4 g-xl-5">
      <div class="col-12 col-lg-6 reveal">
        <div class="about-img-wrap">
          <img src="{{ $settings->get('aboutImg1') }}" alt="About" class="about-img-main"/>
          <img src="{{ $settings->get('aboutImg2') }}" alt="Detail" class="about-img-accent"/>
          <div class="about-badge"><strong>{{ $settings->get('aboutYears') }}</strong><span>Years of Love</span></div>
        </div>
      </div>
      <div class="col-12 col-lg-6 reveal" style="transition-delay:.2s">
        <span class="section-tag">{{ $settings->get('aboutTag') }}</span>
        <h2 class="section-title">{!! $settings->get('aboutTitle') !!}</h2>
        <div class="section-line"></div>
        <p class="section-body mb-3">{{ $settings->get('aboutDesc1') }}</p>
        <p class="section-body mb-3">{{ $settings->get('aboutDesc2') }}</p>
        <div class="about-stats mb-4">
          <div class="about-stat"><strong>{{ $settings->get('aboutStat1Val') }}</strong><small>{{ $settings->get('aboutStat1Lbl') }}</small></div>
          <div class="about-stat"><strong>{{ $settings->get('aboutStat2Val') }}</strong><small>{{ $settings->get('aboutStat2Lbl') }}</small></div>
          <div class="about-stat"><strong>{{ $settings->get('aboutStat3Val') }}</strong><small>{{ $settings->get('aboutStat3Lbl') }}</small></div>
        </div>
        <a href="#packages" class="btn-hero" style="border-color:var(--gold);color:var(--gold)">Explore Packages</a>
      </div>
    </div>
  </div>
</section>

<!-- ══ PROJECTS ══ -->
<section id="projects">
  <div class="container mb-4 mb-lg-5">
    <div class="row g-3">
      <div class="col-12 col-lg-6 reveal">
        <span class="section-tag">Featured Work</span>
        <h2 class="section-title" style="color:var(--cream)">Stories We've<br><em>Had the Honor</em> to Tell</h2>
      </div>
      <div class="col-12 col-lg-6 d-flex align-items-end reveal" style="transition-delay:.2s">
        <p class="section-body">A curated selection of our most beloved weddings — each one a world unto itself.</p>
      </div>
    </div>
  </div>
  <div class="container-fluid px-2 px-md-3">
    <div class="row g-2">
      @if(isset($projects[0]))
      <div class="col-12 col-md-6 reveal">
        <div class="project-card">
          <img src="{{ $projects[0]->img }}" alt="{{ $projects[0]->couple }}" class="project-img project-img-lg"/>
          <div class="project-overlay"><div class="project-info"><h5>{{ $projects[0]->couple }}</h5><small>{{ $projects[0]->location }} · {{ $projects[0]->season }}</small></div></div>
        </div>
      </div>
      @endif
      <div class="col-12 col-md-6 reveal" style="transition-delay:.15s">
        <div class="row g-2">
          @if(isset($projects[1]))
          <div class="col-12">
            <div class="project-card">
              <img src="{{ $projects[1]->img }}" alt="{{ $projects[1]->couple }}" class="project-img project-img-sm"/>
              <div class="project-overlay"><div class="project-info"><h5>{{ $projects[1]->couple }}</h5><small>{{ $projects[1]->location }} · {{ $projects[1]->season }}</small></div></div>
            </div>
          </div>
          @endif
          @if(isset($projects[2]))
          <div class="col-12">
            <div class="project-card">
              <img src="{{ $projects[2]->img }}" alt="{{ $projects[2]->couple }}" class="project-img project-img-sm"/>
              <div class="project-overlay"><div class="project-info"><h5>{{ $projects[2]->couple }}</h5><small>{{ $projects[2]->location }} · {{ $projects[2]->season }}</small></div></div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ GALLERY ══ -->
<section id="gallery">
  <div class="container mb-4 text-center">
    <div class="reveal">
      <span class="section-tag">Gallery</span>
      <h2 class="section-title">A Glimpse Into <em>Our World</em></h2>
    </div>
  </div>
  <div class="container reveal">
    <div class="gallery-grid" id="homeGalleryGrid">
      @foreach($galleries as $gallery)
      <div class="gallery-item" onclick="openLightbox(this)" style="cursor: pointer;">
        <img src="{{ $gallery->img }}" alt="{{ $gallery->alt ?: $gallery->title }}" loading="lazy"/>
        <div class="gallery-hover"><i class="bi bi-zoom-in"></i></div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-4">
      <a href="{{ url('/gallery') }}" class="btn-hero" style="border-color:var(--gold);color:var(--gold)">View Full Gallery</a>
    </div>
  </div>
</section>

<!-- ══ VIDEO ══ -->
<section id="video" style="padding:0;">
  <div class="video-wrap">
    <img src="{{ $settings->get('videoCover') }}" alt="Video Cover" class="video-bg"/>
    <div class="video-overlay">
      <div class="play-btn" data-bs-toggle="modal" data-bs-target="#videoModal"><i class="bi bi-play-fill text-white"></i></div>
      <h2 class="video-title">{{ $settings->get('videoTitle') }}</h2>
      <p class="video-sub">{{ $settings->get('videoSub') }}</p>
    </div>
  </div>
</section>

<!-- ══ PACKAGES ══ -->
<section id="packages">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="section-tag">Investment</span>
      <h2 class="section-title">Packages Crafted with <em>Love</em></h2>
    </div>
    <div class="row g-4 justify-content-center">
      @foreach($packages as $pkg)
      <div class="col-12 col-sm-9 col-md-6 col-lg-4 reveal" style="transition-delay: {{ $loop->index * 0.15 }}s">
        <div class="pkg-card {{ $pkg->featured ? 'featured' : '' }}">
          @if($pkg->badge)
          <div class="pkg-badge">{{ $pkg->badge }}</div>
          @endif
          <span class="pkg-name">{{ $pkg->name }}</span>
          <div class="pkg-price" {!! $pkg->featured ? 'style="color:var(--gold-light)"' : '' !!}><sup>$</sup>{{ number_format($pkg->price) }}</div>
          <ul class="pkg-feature-list">
            @foreach(explode("\n", $pkg->features) as $feature)
                @if(trim($feature))
                    @if(str_starts_with(trim($feature), '-'))
                        <li class="pkg-feature-item" style="opacity:.38"><i class="bi bi-x"></i> {{ ltrim(trim($feature), '-') }}</li>
                    @else
                        <li class="pkg-feature-item"><i class="bi bi-check2" {!! $pkg->featured ? 'style="color:var(--gold)"' : '' !!}></i> {{ trim($feature) }}</li>
                    @endif
                @endif
            @endforeach
          </ul>
          <button class="btn-pkg" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Package</button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section id="testimonials">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="section-tag">Kind Words</span>
      <h2 class="section-title">What Our Couples <em>Say</em></h2>
    </div>
    <div class="row g-4">
      @foreach($testimonials as $testi)
      <div class="col-12 col-md-6 col-lg-4 reveal" style="transition-delay: {{ $loop->index * 0.15 }}s">
        <div class="testi-card">
          <div class="stars">{{ str_repeat('★', $testi->rating) }}{{ str_repeat('☆', 5 - $testi->rating) }}</div>
          <p class="testi-quote">"{{ $testi->quote }}"</p>
          <span class="testi-author"><strong>{{ explode(' · ', $testi->couple)[0] }}</strong> · {{ $testi->location }}</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ══ CTA ══ -->
<section id="cta">
  <div class="inner py-5">
    <div class="container text-center py-4 py-lg-5">
      <span class="section-tag" style="color:var(--gold-light)">{{ $settings->get('ctaTag') }}</span>
      <h2 class="section-title" style="color:#fff;margin-bottom:1rem">{!! $settings->get('ctaTitle') !!}</h2>
      <p style="color:rgba(255,255,255,.6);font-size:clamp(.78rem,1.4vw,.86rem);letter-spacing:.08em;margin-bottom:2rem;font-weight:300">{{ $settings->get('ctaSub') }}</p>
      <button class="btn-cta" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Your Date</button>
    </div>
  </div>
</section>
@endsection
