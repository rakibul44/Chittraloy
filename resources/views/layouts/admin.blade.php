<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>@yield('title', 'Chittraloy — Admin Dashboard')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('admin_assets/css/admin.css') }}"/>
  @yield('styles')
</head>
<body>

<div class="admin-layout">
  <!-- Sidebar Overlay (mobile) -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Chittraloy" class="sidebar-logo-img"/>
      <span class="sidebar-badge">Admin</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-group">
        <span class="nav-group-label">Main</span>
        <button class="nav-item active" data-section="dashboard"><i class="fas fa-th-large"></i> Dashboard</button>
      </div>
      <div class="nav-group">
        <span class="nav-group-label">Content</span>
        <button class="nav-item" data-section="hero"><i class="fas fa-image"></i> Hero Slides</button>
        <button class="nav-item" data-section="about"><i class="fas fa-user-edit"></i> About Section</button>
        <button class="nav-item" data-section="projects"><i class="fas fa-camera-retro"></i> Projects</button>
        <button class="nav-item" data-section="gallery"><i class="fas fa-images"></i> Gallery</button>
        <button class="nav-item" data-section="packages"><i class="fas fa-box-open"></i> Packages</button>
        <button class="nav-item" data-section="testimonials"><i class="fas fa-quote-right"></i> Testimonials</button>
        <button class="nav-item" data-section="video"><i class="fas fa-film"></i> Video Section</button>
      </div>
      <div class="nav-group">
        <span class="nav-group-label">Data</span>
        <button class="nav-item" data-section="inquiries"><i class="fas fa-envelope-open-text"></i> Inquiries <span class="badge" id="inquiryBadge">0</span></button>
        <button class="nav-item" data-section="contacts"><i class="fas fa-address-book"></i> Contacts</button>
      </div>
      <div class="nav-group">
        <span class="nav-group-label">System</span>
        <button class="nav-item" data-section="settings"><i class="fas fa-cog"></i> Settings</button>
      </div>
    </nav>
    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="sidebar-avatar"><i class="fas fa-user"></i></div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" id="adminName">{{ Auth::user()->name ?? 'Admin' }}</div>
          <div class="sidebar-user-role">Administrator</div>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin-top:.6rem;">
        @csrf
        <button type="submit" style="width:100%;padding:.5rem .8rem;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);border-radius:6px;color:#fca5a5;font-family:inherit;font-size:.72rem;cursor:pointer;letter-spacing:.06em;transition:background .2s;">
          <i class="fas fa-sign-out-alt" style="margin-right:.4rem;"></i> Sign Out
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main-content">
    <header class="top-header">
      <div class="header-left">
        <button class="hamburger-btn" id="hamburgerBtn"><i class="fas fa-bars"></i></button>
        <h1 class="page-title" id="pageTitle">@yield('page_title', 'Dashboard')</h1>
      </div>
      <div class="header-right">
        <div class="header-search"><i class="fas fa-search"></i><input type="text" placeholder="Search..." id="globalSearch"/></div>
        <button class="header-btn" title="Notifications"><i class="fas fa-bell"></i><span class="dot"></span></button>
        <a href="{{ url('/') }}" class="header-btn" title="View Site" target="_blank"><i class="fas fa-external-link-alt"></i></a>
      </div>
    </header>

    <div class="page-body">
      @yield('content')
    </div><!-- /page-body -->
  </div><!-- /main-content -->
</div><!-- /admin-layout -->

<!-- ══════ MODALS ══════ -->
@yield('modals')

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script src="{{ asset('admin_assets/js/admin.js') }}"></script>
@yield('scripts')
</body>
</html>
