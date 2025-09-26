<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Service Providers - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary-purple: #7e22ce;
      --light-yellow: #fff3b0;
      --hover-yellow: #ffef9e;
      --soft-bg: #fffdf5;
      --pill-bg: #f8f0ff;
      --pill-hover: #f3e8ff;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--soft-bg);
    }

    .text-purple {
      color: var(--primary-purple);
    }

    .btn-custom-yellow {
      background-color: var(--light-yellow);
      color: var(--primary-purple);
      font-weight: 600;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .btn-custom-yellow:hover {
      background-color: var(--hover-yellow);
      transform: scale(1.05);
    }

    .card-custom {
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s ease;
    }

    .card-custom:hover {
      transform: scale(1.02);
    }

    .category-scroll {
      display: flex;
      overflow-x: auto;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    .category-pill {
      flex: 0 0 auto;
      width: 200px;
      background-color: white;
      border-radius: 16px;
      padding: 1rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      text-align: center;
    }

    .category-pill img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 12px;
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.4em 0.6em;
      border-radius: 12px;
      background-color: var(--pill-bg);
      color: var(--primary-purple);
    }

    footer {
      background-color: white;
      border-top: 1px solid #eee;
      padding: 1rem 0;
    }
  </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand text-purple fw-bold" href="#">FixMate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- All Providers Section -->
    <section class="py-5">
      <div class="container">
        <h2 class="text-center text-purple fw-bold mb-4">{{ __('blade.All Service Providers') }}</h2>

       <!-- Search Bar -->
       <div class="container mb-4">
          <form action="{{ route('providers.index') }}" method="GET" class="row g-2 justify-content-center">
            <div class="col-md-6">
              <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control border-purple"
                    placeholder="{{ __('blade.Search by shop name..') }}">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-custom-yellow">
                <i class="bi bi-search"></i> {{ __('blade.Search') }}
              </button>
            </div>
          </form>
        </div>

      {{-- Sort by view --}}
      <div class="container mb-3 text-end">
        <form method="GET" action="{{ route('providers.index') }}">
          <div class="d-inline-block me-2">
            <select name="sort" class="form-select" onchange="this.form.submit()">
              <option value="">{{ __('blade.Sort by Views') }}</option>
              <option value="views_asc" {{ request('sort') === 'views_asc' ? 'selected' : '' }}>
                {{ __('blade.Views Asc') }}
              </option>
              <option value="views_desc" {{ request('sort') === 'views_desc' ? 'selected' : '' }}>
                {{ __('blade.Views Desc') }}
              </option>
            </select>
          </div>

          @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
          @endif
          @if(request('city'))
            <input type="hidden" name="city" value="{{ request('city') }}">
          @endif
        </form>
      </div>

      {{-- Filter form --}}
      <div class="container mb-4">
        <form method="GET" action="{{ route('providers.index') }}" class="row g-3 align-items-end">

          <!-- Category -->
          <div class="col-md-3">
            <label class="form-label text-purple">{{ __('blade.Category') }}</label>
            <select name="category" class="form-select border-purple">
              <option value="">{{ __('blade.All Categories') }}</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Subcategory -->
          <div class="col-md-3">
            <label class="form-label text-purple">{{ __('blade.Subcategory') }}</label>
            <select name="subcategory" class="form-select border-purple">
              <option value="">{{ __('blade.All Subcategories') }}</option>
              @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ request('subcategory') == $subcategory->id ? 'selected' : '' }}>
                  {{ $subcategory->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- State -->
          <div class="col-md-2">
            <label class="form-label text-purple">{{ __('blade.State') }}</label>
            <select name="state" class="form-select border-purple">
              <option value="">{{ __('blade.All States') }}</option>
              @foreach($states as $state)
                <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                  {{ $state->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- City -->
          <div class="col-md-2">
            <label class="form-label text-purple">{{ __('blade.City') }}</label>
            <select name="city" class="form-select border-purple">
              <option value="">{{ __('blade.All Cities') }}</option>
              @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Tags -->
          <div class="col-md-2">
            <label class="form-label text-purple">{{ __('blade.Tag') }}</label>
            <select name="tag" class="form-select border-purple">
              <option value="">{{ __('blade.All Tags') }}</option>
              @foreach($tags as $tag)
                <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                  {{ $tag->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Buttons -->
          <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-custom-yellow me-2">
              <i class="bi bi-funnel-fill"></i> {{ __('blade.Apply Filters') }}
            </button>
            <a href="{{ route('providers.index') }}" class="btn btn-outline-danger">
              <i class="bi bi-x-circle"></i> {{ __('blade.Reset Filters') }}
            </a>
          </div>
        </form>
      </div>

        @if($providers->count())
          <div class="category-scroll px-2">
            @foreach ($providers as $provider)
              <a href="{{ route('providers.show', $provider->id) }}" class="text-decoration-none">
                <div class="category-pill card-custom">
                  <img src="{{ asset('storage/' . $provider->thumbnail) }}" alt="{{ $provider->shop_name }}">
                  <h6 class="text-purple mt-3 fw-semibold">{{ $provider->shop_name }}</h6>
                  <p class="small text-muted mb-2"><i class="bi bi-eye"></i> {{ __('blade.Views') }}: {{ $provider->views }}</p>

                  @if($provider->tags->count())
                    <div class="d-flex flex-wrap justify-content-center gap-1">
                      @foreach($provider->tags as $tag)
                        <span class="badge">{{ $tag->name }}</span>
                      @endforeach
                    </div>
                  @endif
                </div>
              </a>
            @endforeach
          </div>
        @else
          <p class="text-center text-muted">{{ __('blade.No providers') }}</p>
        @endif
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
      <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.All rights reserved.') }}</p>
    </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>