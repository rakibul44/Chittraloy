<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>@yield('title', isset($settings) ? $settings->get('siteName', 'Chittraloy – Wedding Photography') : 'Chittraloy – Wedding Photography')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @yield('styles')
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- ══ NAVBAR ══ -->
<nav class="navbar navbar-expand-lg" id="mainNav">
  <div class="container-fluid px-3">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Chittraloy" class="brand-logo"/></a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-0 gap-lg-1 mt-1 mt-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ url('/#about') }}">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/#projects') }}">Work</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/#gallery') }}">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/#packages') }}">Packages</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/#video') }}">Film</a></li>
      </ul>
      <div class="navbar-nav-btns">
        <button class="btn-nav-booking" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</button>
      </div>
    </div>
  </div>
</nav>

@yield('content')

<!-- ══ FOOTER ══ -->
<footer>
  <div class="container">
    <div class="row g-4 g-lg-5">
      <div class="col-12 col-lg-4">
        <span class="footer-brand"><img src="{{ asset('assets/images/logo.png') }}" alt="Chittraloy" class="footer-logo"/></span>
        <p style="font-size:.8rem;line-height:1.9;font-weight:300;max-width:270px;margin-bottom:1.3rem;color:rgba(250,246,240,.42)">{{ isset($settings) ? $settings->get('footerTagline') : 'Luxury wedding photography for couples who believe their story is worth telling beautifully.' }}</p>
        <div>
          @if(isset($settings) && $settings->get('socialIg'))<a href="{{ $settings->get('socialIg') }}" class="social-btn"><i class="bi bi-instagram"></i></a>@endif
          @if(isset($settings) && $settings->get('socialPi'))<a href="{{ $settings->get('socialPi') }}" class="social-btn"><i class="bi bi-pinterest"></i></a>@endif
          @if(isset($settings) && $settings->get('socialFb'))<a href="{{ $settings->get('socialFb') }}" class="social-btn"><i class="bi bi-facebook"></i></a>@endif
          @if(isset($settings) && $settings->get('socialYt'))<a href="{{ $settings->get('socialYt') }}" class="social-btn"><i class="bi bi-youtube"></i></a>@endif
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <p class="footer-title">Navigate</p>
        <a href="{{ url('/#about') }}" class="footer-link">About</a>
        <a href="{{ url('/#projects') }}" class="footer-link">Work</a>
        <a href="{{ url('/#gallery') }}" class="footer-link">Gallery</a>
        <a href="{{ url('/#packages') }}" class="footer-link">Packages</a>
        <a href="{{ url('/#video') }}" class="footer-link">Films</a>
      </div>
      <div class="col-6 col-lg-2">
        <p class="footer-title">Services</p>
        <a href="#" class="footer-link">Wedding</a>
        <a href="#" class="footer-link">Engagement</a>
        <a href="#" class="footer-link">Elopement</a>
        <a href="#" class="footer-link">Destination</a>
        <a href="#" class="footer-link">Portraits</a>
      </div>
      <div class="col-12 col-lg-4">
        <p class="footer-title">Stay in Touch</p>
        <p style="font-size:.78rem;font-weight:300;margin-bottom:.9rem;color:rgba(250,246,240,.38)">Get inspiration & behind-the-scenes stories in your inbox.</p>
        <div class="d-flex">
          <input type="email" class="footer-input" placeholder="Your email address"/>
          <button class="btn-nav-booking" style="padding:.58rem .9rem;white-space:nowrap;flex-shrink:0;font-size:.68rem">Subscribe</button>
        </div>
        <p style="font-size:.7rem;margin-top:.9rem;color:rgba(250,246,240,.26)"><i class="bi bi-geo-alt me-1" style="color:var(--gold)"></i> {{ isset($settings) ? $settings->get('footerLocations') : 'New York · Paris · Amalfi · Worldwide' }}</p>
        <p style="font-size:.7rem;margin-top:.38rem;color:rgba(250,246,240,.26)"><i class="bi bi-envelope me-1" style="color:var(--gold)"></i> {{ isset($settings) ? $settings->get('siteEmail') : 'hello@chittraloy.com' }}</p>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
        <span>{{ isset($settings) ? $settings->get('footerCopy') : '© 2025 Chittraloy Photography. All rights reserved.' }}</span>
        <span>Privacy Policy · Terms of Service</span>
      </div>
    </div>
  </div>
</footer>

<!-- ══ LIGHTBOX ══ -->
<div class="lightbox" id="lightbox">
  <span class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></span>
  <img src="" id="lightboxImg" alt="Gallery"/>
</div>

<!-- ══ VIDEO MODAL ══ -->
<div class="modal fade" id="videoModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header border-0 py-2">
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0">
        <div class="video-modal-inner">
          <script>
            const vm = document.getElementById('videoModal');
            const videoUrl = '{{ isset($settings) ? $settings->get("videoUrl", "https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1") : "https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" }}';
            vm.addEventListener('show.bs.modal', () => { document.getElementById('videoFrame').src=videoUrl; });
            vm.addEventListener('hide.bs.modal', () => { document.getElementById('videoFrame').src=''; });
          </script>
          <iframe id="videoFrame" src="" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ BOOKING MODAL ══ -->
<div class="modal fade" id="bookingModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reserve Your Date</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="font-size:.78rem;color:var(--warm-gray);margin-bottom:1.4rem;letter-spacing:.04em">Fill in the form below and we'll get back to you within 24 hours.</p>
        <form id="bookingForm">
        <div class="row g-3">
          <div class="col-12 col-sm-6"><label class="form-label">Your Name</label><input type="text" class="form-control" name="name" id="bookingName" placeholder="First & Last Name" required/></div>
          <div class="col-12 col-sm-6"><label class="form-label">Partner's Name</label><input type="text" class="form-control" name="partner" id="bookingPartner" placeholder="First & Last Name"/></div>
          <div class="col-12 col-sm-6"><label class="form-label">Email Address</label><input type="email" class="form-control" name="email" id="bookingEmail" placeholder="hello@example.com" required/></div>
          <div class="col-12 col-sm-6"><label class="form-label">Phone Number</label><input type="tel" class="form-control" name="phone" id="bookingPhone" placeholder="+1 (555) 000-0000"/></div>
          <div class="col-12 col-sm-6"><label class="form-label">Wedding Date</label><input type="date" class="form-control" name="date" id="bookingDate"/></div>
          <div class="col-12 col-sm-6">
            <label class="form-label">Package Interest</label>
            <select class="form-select" name="package" id="bookingPackage">
              <option value="">Select a package</option>
              @if(isset($packages))
                @foreach($packages as $pkg)
                  <option>{{ $pkg->name }} – ৳{{ number_format($pkg->price) }}</option>
                @endforeach
              @else
                <option>Essence – ৳1,800</option>
                <option>Lumière – ৳3,200</option>
                <option>Forever – ৳5,500</option>
              @endif
              <option>Custom / Not sure yet</option>
            </select>
          </div>
          <div class="col-12"><label class="form-label">Venue / Location</label><input type="text" class="form-control" name="venue" id="bookingVenue" placeholder="City, Country or Venue Name"/></div>
          <div class="col-12"><label class="form-label">Tell Us About Your Day</label><textarea class="form-control" rows="3" name="message" id="bookingMessage" placeholder="Share details about your wedding vision..."></textarea></div>
          <div class="col-12"><button type="submit" class="btn-submit" id="bookingSubmitBtn">Send Inquiry <i class="bi bi-arrow-right ms-2"></i></button></div>
        </div>
        </form>
        <div id="bookingSuccess" style="display:none;text-align:center;padding:2rem 0;">
          <i class="bi bi-check-circle" style="font-size:3rem;color:var(--gold);display:block;margin-bottom:1rem;"></i>
          <h5 style="color:var(--cream);font-family:'Cormorant Garamond',serif;font-size:1.3rem;margin-bottom:.5rem;">Thank You!</h5>
          <p style="font-size:.82rem;color:var(--warm-gray);">Your inquiry has been submitted. We'll get back to you within 24 hours.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ SIGN IN MODAL ══ -->
<div class="modal fade" id="signinModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" style="max-width:min(430px,95vw)">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Client Login</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="font-size:.78rem;color:var(--warm-gray);margin-bottom:1.4rem">Access your private gallery and wedding materials.</p>
        <div class="row g-3">
          <div class="col-12"><label class="form-label">Email Address</label><input type="email" class="form-control" placeholder="hello@example.com"/></div>
          <div class="col-12"><label class="form-label">Password</label><input type="password" class="form-control" placeholder="••••••••"/></div>
          <div class="col-12"><button class="btn-submit">Sign In <i class="bi bi-arrow-right ms-2"></i></button></div>
          <div class="col-12 text-center"><a href="#" style="font-size:.7rem;color:var(--warm-gray);text-decoration:none">Forgot your password?</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@yield('scripts')
</body>
</html>
