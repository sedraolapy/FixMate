<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.AllOffers') }} - FixMate</title>
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

    body { font-family: 'Segoe UI', sans-serif; background-color: var(--soft-bg); }
    .text-purple { color: var(--primary-purple); }
    .btn-custom-yellow {
      background-color: var(--light-yellow);
      color: var(--primary-purple);
      font-weight: 600;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .btn-custom-yellow:hover { background-color: var(--hover-yellow); transform: scale(1.05); }
    .card-custom { border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.2s ease; }
    .card-custom:hover { transform: scale(1.02); }
    .category-scroll { display: flex; overflow-x: auto; gap: 1rem; padding-bottom: 1rem; }
    .category-pill { flex: 0 0 auto; width: 200px; background-color: white; border-radius: 16px; padding: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center; }
    .category-pill img { width: 100%; height: 120px; object-fit: cover; border-radius: 12px; }
    .badge { font-size: 0.75rem; padding: 0.4em 0.6em; border-radius: 12px; background-color: var(--pill-bg); color: var(--primary-purple); }
    footer { background-color: white; border-top: 1px solid #eee; padding: 1rem 0; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand text-purple fw-bold" href="#">FixMate</a>
  </div>
</nav>

<!-- Offers Section -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center text-purple fw-bold mb-4">{{ __('blade.AllOffers') }}</h2>

    <!-- Search Bar -->
    <div class="container mb-4">
      <form action="{{ route('offers.index') }}" method="GET" class="row g-2 justify-content-center">
        <div class="col-md-6">
          <input type="text" name="search" value="{{ request('search') }}"
                 class="form-control border-purple"
                 placeholder="{{ __('blade.SearchByShopName') }}">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-custom-yellow">
            <i class="bi bi-search"></i> {{ __('blade.Search') }}
          </button>
        </div>
      </form>
    </div>

    @if($offers->count())
      <div class="category-scroll px-2">
        @foreach ($offers as $offer)
          <a href="{{ route('providers.show', $offer->serviceProvider->id) }}" class="text-decoration-none">
            <div class="category-pill card-custom">
              <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}">
              <h6 class="text-purple mt-3 fw-semibold">{{ $offer->title }}</h6>
              <p class="small text-muted mb-2">{{ $offer->serviceProvider->name }}</p>

              @if($offer->tags && $offer->tags->count())
                <div class="d-flex flex-wrap justify-content-center gap-1">
                  @foreach($offer->tags as $tag)
                    <span class="badge">{{ $tag->name }}</span>
                  @endforeach
                </div>
              @endif
            </div>
          </a>
        @endforeach
      </div>
    @else
      <p class="text-center text-muted">{{ __('blade.NoOffersAvailable') }}</p>
    @endif
  </div>
</section>

<!-- Footer -->
<footer class="text-center">
  <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.AllRightsReserved') }}</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
