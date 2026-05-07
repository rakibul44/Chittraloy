<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Admin Login — Chittraloy</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #0c0a09; --surface: #1a1714; --border: rgba(200,170,110,.12);
      --gold: #c8a96e; --gold-light: #e2cc9c; --cream: #faf6f0;
      --text-muted: rgba(250,246,240,.42); --danger: #ef4444;
    }
    body {
      font-family: 'Jost', sans-serif; background: var(--bg); color: var(--cream);
      min-height: 100vh; display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden;
    }
    body::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(ellipse at 30% 20%, rgba(200,170,110,.06) 0%, transparent 60%),
                  radial-gradient(ellipse at 70% 80%, rgba(200,170,110,.04) 0%, transparent 50%);
      pointer-events: none;
    }
    .login-card {
      position: relative; width: min(420px, 92vw); padding: 3rem 2.4rem;
      background: var(--surface); border: 1px solid var(--border);
      border-radius: 16px; z-index: 1;
      box-shadow: 0 25px 60px rgba(0,0,0,.35), 0 0 80px rgba(200,170,110,.03);
    }
    .login-logo {
      display: block; width: 60px; height: 60px; object-fit: contain;
      margin: 0 auto 1.2rem; filter: brightness(1.1);
    }
    .login-title {
      font-family: 'Cormorant Garamond', serif; font-size: 1.6rem;
      text-align: center; font-weight: 400; margin-bottom: .3rem; letter-spacing: .02em;
    }
    .login-sub {
      text-align: center; font-size: .78rem; color: var(--text-muted);
      letter-spacing: .06em; margin-bottom: 2rem; font-weight: 300;
    }
    .form-group { margin-bottom: 1.2rem; }
    .form-label {
      display: block; font-size: .7rem; font-weight: 400;
      color: var(--text-muted); letter-spacing: .1em;
      text-transform: uppercase; margin-bottom: .5rem;
    }
    .form-input {
      width: 100%; padding: .72rem 1rem; background: rgba(255,255,255,.04);
      border: 1px solid var(--border); border-radius: 8px;
      color: var(--cream); font-family: inherit; font-size: .85rem;
      transition: border-color .3s, box-shadow .3s; outline: none;
    }
    .form-input:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(200,170,110,.1);
    }
    .form-input::placeholder { color: rgba(250,246,240,.2); }
    .remember-row {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 1.6rem; font-size: .76rem;
    }
    .remember-row label { display: flex; align-items: center; gap: .4rem; color: var(--text-muted); cursor: pointer; }
    .remember-row input[type="checkbox"] { accent-color: var(--gold); width: 14px; height: 14px; }
    .remember-row a { color: var(--gold); text-decoration: none; font-weight: 400; }
    .remember-row a:hover { text-decoration: underline; }
    .btn-login {
      width: 100%; padding: .82rem; background: linear-gradient(135deg, var(--gold), #b8944e);
      border: none; border-radius: 8px; color: #1a1410; font-family: inherit;
      font-size: .82rem; font-weight: 500; letter-spacing: .08em;
      text-transform: uppercase; cursor: pointer;
      transition: transform .2s, box-shadow .3s;
    }
    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 25px rgba(200,170,110,.25);
    }
    .btn-login:active { transform: translateY(0); }
    .error-msg {
      background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.25);
      border-radius: 8px; padding: .7rem 1rem; margin-bottom: 1.2rem;
      font-size: .78rem; color: #fca5a5;
    }
    .back-link {
      display: block; text-align: center; margin-top: 1.4rem;
      font-size: .74rem; color: var(--text-muted); text-decoration: none;
    }
    .back-link:hover { color: var(--gold); }
    .divider {
      display: flex; align-items: center; gap: .8rem;
      margin: 1.4rem 0; font-size: .68rem; color: var(--text-muted);
      letter-spacing: .08em; text-transform: uppercase;
    }
    .divider::before, .divider::after {
      content: ''; flex: 1; height: 1px;
      background: var(--border);
    }
  </style>
</head>
<body>
  <div class="login-card">
    <img src="{{ asset('assets/images/logo.png') }}" alt="Chittraloy" class="login-logo"/>
    <h1 class="login-title">Welcome Back</h1>
    <p class="login-sub">Sign in to your admin dashboard</p>

    @if($errors->any())
      <div class="error-msg">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    @if(session('success'))
      <div class="error-msg" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.25);color:#86efac;">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf
      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input class="form-input" id="email" name="email" type="email" placeholder="admin@chittraloy.com" value="{{ old('email') }}" required autofocus/>
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input class="form-input" id="password" name="password" type="password" placeholder="••••••••" required/>
      </div>
      <div class="remember-row">
        <label><input type="checkbox" name="remember"/> Remember me</label>
      </div>
      <button type="submit" class="btn-login">Sign In</button>
    </form>
    <a href="{{ url('/') }}" class="back-link">← Back to Website</a>
  </div>
</body>
</html>
