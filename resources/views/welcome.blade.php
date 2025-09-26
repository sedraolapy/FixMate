<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.FixMate - Dashboard') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fdfcf9;
      color: #444;
    }
    .navbar-brand {
      color: #7e22ce !important;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .hero {
      background: linear-gradient(90deg, #a855f7, #7e22ce);
      color: white;
      padding: 120px 0;
    }
    .btn-custom-yellow {
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-custom-yellow:hover {
      background-color: #ffef9e;
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 1rem;
    }
    .feature-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .cta {
      background: #fff3b0;
      color: #581c87;
      padding: 100px 0;
    }
    footer {
      border-top: 1px solid #eee;
    }
    .lang-dropdown button {
      background: none;
      border: none;
      font-weight: 600;
      color: #7e22ce;
    }

    body[dir="rtl"] {
    text-align: right;
}

/* Navbar adjustments for RTL */
body[dir="rtl"] .navbar-nav {
    margin-left: 0;
    margin-right: auto;
    text-align: right;
}

/* Feature cards for RTL */
body[dir="rtl"] .feature-card {
    direction: rtl;
}

/* Icon spacing for RTL */
body[dir="rtl"] .bi {
    margin-left: 0.5rem;
    margin-right: 0;
}
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand" href="#">FixMate</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-lg-center gap-lg-3">
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('blade.Home') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact.us') }}">{{ __('blade.Contact') }}</a></li>

          {{-- If user is guest (not logged in) --}}
          @guest('customer')
            <li class="nav-item">
              <a class="btn btn-custom-yellow rounded-pill px-4" href="{{ route('login') }}">
                {{ __('blade.Login') }}
              </a>
            </li>
          @endguest

          {{-- If user is logged in --}}
          @auth('customer')
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-custom-yellow rounded-pill px-4">
                  {{ __('blade.Logout') }}
                </button>
              </form>
            </li>
          @endauth

          <!-- Language Switcher -->
          <li class="nav-item dropdown lang-dropdown">
            <button class="dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-translate me-1"></i>{{ strtoupper(app()->getLocale()) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form method="POST" action="{{ route('language.switch') }}">
                  @csrf
                  <input type="hidden" name="lang" value="en">
                  <button type="submit" class="dropdown-item">English</button>
                </form>
              </li>
              <li>
                <form method="POST" action="{{ route('language.switch') }}">
                  @csrf
                  <input type="hidden" name="lang" value="ar">
                  <button type="submit" class="dropdown-item">العربية</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">{{ __('blade.Shine Bright With Smart Services') }}</h1>
      <p class="lead mt-3 mb-4">{{ __('blade.Empowering you with reliable support and vibrant solutions.') }}</p>
      <a href="{{ route('register') }}" class="btn btn-custom-yellow btn-lg rounded-pill shadow">{{ __('blade.Join Us Now') }}</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-4 fw-semibold" style="color:#7e22ce;">{{ __('blade.Why Choose Us') }}</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-4 bg-white shadow feature-card">
            <i class="bi bi-lightning-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">{{ __('blade.Quick Results') }}</h5>
            <p>{{ __('blade.Time-saving solutions that don’t sacrifice quality.') }}</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white shadow feature-card">
            <i class="bi bi-shield-lock-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">{{ __('blade.Secure & Trustworthy') }}</h5>
            <p>{{ __('blade.Privacy-first service with complete peace of mind.') }}</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white shadow feature-card">
            <i class="bi bi-chat-dots-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">{{ __('blade.Dedicated Support') }}</h5>
            <p>{{ __('blade.Round-the-clock help from caring professionals.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta text-center">
    <div class="container">
      <h2 class="display-5 fw-bold">{{ __("blade.Let's Build Something Brilliant Together") }}</h2>
      <p class="lead mt-3 mb-4">{{ __("blade.We're ready when you are — your journey starts here.") }}</p>
      <a href="{{ route('register') }}" class="btn btn-light btn-lg fw-semibold rounded-pill shadow" style="color:#7e22ce;">
        {{ __('blade.Sign Up Today') }}
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-center py-4">
    <p class="mb-1" style="color:#7e22ce;">&copy; 2025 FixMate. {{ __('blade.All rights reserved.') }}</p>
    <div>
      <a href="#" class="text-decoration-none mx-2 text-muted">{{ __('blade.Privacy Policy') }}</a> |
      <a href="#" class="text-decoration-none mx-2 text-muted">{{ __('blade.Terms of Service') }}</a>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
