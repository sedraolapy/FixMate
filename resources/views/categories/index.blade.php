<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.All Categories') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
    }
    .btn-custom-yellow {
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      border: none;
    }
    .btn-custom-yellow:hover {
      background-color: #ffef9e;
      transform: scale(1.05);
    }
    .text-purple { color: #7e22ce; }
    .category-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 1.5rem;
      padding-top: 2rem;
    }
    .category-pill {
      background-color: #f8f0ff;
      color: #7e22ce;
      border-radius: 50px;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .category-pill:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      background-color: #f3e8ff;
    }
    .category-pill img {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 0.5rem;
    }
    .category-pill h6 {
      margin: 0;
      font-weight: 600;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-purple" href="#">FixMate</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('blade.Home') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact.us') }}">{{ __('blade.Contact') }}</a></li>
          <li class="nav-item"><a class="btn btn-custom-yellow" href="{{ route('register') }}">{{ __('blade.Sign Up') }}</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Search Bar -->
  <div class="container mt-4 mb-3">
    <form method="GET" action="{{ route('categories.index') }}" class="d-flex gap-2">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('blade.Search by name, subcategory') }}">
      <button type="submit" class="btn btn-custom-yellow">
        <i class="bi bi-search"></i> {{ __('blade.Search') }}
      </button>
    </form>
  </div>

  <!-- Filter Form -->
  <div class="container mb-4">
    <form method="GET" action="{{ route('categories.index') }}" class="d-flex gap-2 align-items-center">
      <select name="tag" class="form-select">
        <option value="">{{ __('blade.Filter by Tag') }}</option>
        @foreach($tags as $tag)
          <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
            {{ $tag->name }}
          </option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-custom-yellow">
        <i class="bi bi-funnel-fill"></i> {{ __('blade.Filter') }}
      </button>
      @if(request('search') || request('tag'))
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-x-circle"></i> {{ __('blade.Reset') }}
        </a>
      @endif
    </form>
  </div>

  <!-- Hero Section -->
  <section class="hero text-center" style="background: linear-gradient(to right, #a855f7, #7e22ce); color: white; padding: 80px 0;">
    <div class="container">
      <h1 class="display-5 fw-bold">{{ __('blade.Explore All Categories') }}</h1>
      <p class="lead mt-3 mb-4">{{ __('blade.Find the service category that suits your needs.') }}</p>
      <a href="{{ url()->previous() }}" class="btn btn-light text-purple fw-semibold px-4 py-2">
        <i class="bi bi-arrow-left"></i> {{ __('blade.Back to Dashboard') }}
      </a>
    </div>
  </section>

  <!-- Categories Grid -->
  <section class="py-5">
    <div class="container">
      @if($categories->count())
        <div class="category-grid">
          @foreach ($categories as $category)
            @auth('customer')
              <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                <div class="category-pill">
                  <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                  <h6>{{ $category->name }}</h6>
                </div>
              </a>
            @else
              <div class="category-pill" style="cursor: not-allowed;" title="{{ __('blade.Login to view details') }}">
                <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                <h6>{{ $category->name }}</h6>
              </div>
            @endauth
          @endforeach
        </div>
      @else
        <p class="text-center text-muted">{{ __('blade.No categories found.') }}</p>
      @endif
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-center py-4">
    <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.All rights reserved.') }}</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
