@extends('layouts.main')

@section('title', 'Register — Chittraloy')

@section('styles')
<style>
  .auth-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 120px 20px 60px;
    background: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1800&q=80') center/cover no-repeat fixed;
    position: relative;
  }
  .auth-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(18, 17, 15, 0.85);
  }
  .auth-card {
    position: relative;
    background: rgba(30, 28, 25, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(250, 246, 240, 0.08);
    padding: 3rem;
    max-width: 480px;
    width: 100%;
    z-index: 1;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
  }
  .auth-title {
    color: var(--gold-light);
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.5rem;
    font-style: italic;
    margin-bottom: 0.5rem;
    text-align: center;
  }
  .auth-sub {
    color: var(--warm-gray);
    text-align: center;
    font-size: 0.85rem;
    letter-spacing: 0.04em;
    margin-bottom: 2rem;
  }
  .form-control {
    background: rgba(18, 17, 15, 0.6) !important;
  }
  .btn-submit {
    width: 100%;
    margin-top: 1rem;
  }
  .auth-links {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 0.8rem;
  }
  .auth-links a {
    color: var(--gold);
    text-decoration: none;
    transition: color 0.3s ease;
  }
  .auth-links a:hover {
    color: var(--cream);
  }
  .invalid-feedback {
    display: block;
    color: #ff6b6b;
    font-size: 0.75rem;
    margin-top: 0.25rem;
  }
  @media (max-width: 576px) {
    .auth-card { padding: 2rem 1.5rem; }
  }
</style>
@endsection

@section('content')
<section class="auth-section">
  <div class="auth-card reveal visible">
    <h1 class="auth-title">Welcome</h1>
    <p class="auth-sub">Create your account to access the dashboard.</p>
    
    <form method="POST" action="{{ url('/register') }}">
      @csrf
      
      <div class="mb-3">
        <label class="form-label" style="color: var(--cream);">Full Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="First & Last Name" required autofocus>
        @error('name')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      
      <div class="mb-3">
        <label class="form-label" style="color: var(--cream);">Email Address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="hello@example.com" required>
        @error('email')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      
      <div class="mb-3">
        <label class="form-label" style="color: var(--cream);">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
        @error('password')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      
      <div class="mb-4">
        <label class="form-label" style="color: var(--cream);">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
      </div>
      
      <button type="submit" class="btn-submit">Create Account <i class="bi bi-arrow-right ms-2"></i></button>
      
      <div class="auth-links">
        <span style="color: var(--warm-gray);">Already have an account?</span> 
        <a href="#" data-bs-toggle="modal" data-bs-target="#signinModal">Sign In</a>
      </div>
    </form>
  </div>
</section>
@endsection
