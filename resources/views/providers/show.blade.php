<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $provider->shop_name }} - FixMate</title>
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
    .card-custom { border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .offer-card img { max-height: 150px; object-fit: cover; border-radius: 12px; }
    .badge-pill { background-color: var(--pill-bg); color: var(--primary-purple); font-weight: 500; }
    footer { background-color: white; border-top: 1px solid #eee; padding: 1rem 0; }
    .carousel-inner img {
  transition: transform 0.3s ease;
}
.carousel-inner img:hover {
  transform: scale(1.05);
}
.img-thumbnail {
  border-radius: 8px;
  border: 2px solid #eee;
  transition: transform 0.2s ease;
}
.img-thumbnail:hover {
  transform: scale(1.1);
  border-color: var(--primary-purple);
}

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand text-purple fw-bold" href="#">FixMate</a>
  </div>
</nav>

<!-- Provider Details -->
<section class="py-5">
  <div class="container">
    <div class="card card-custom p-4 bg-white">
      <div class="row g-4">
        <!-- Thumbnail -->
        <div class="col-md-4 text-center">
          <img src="{{ asset('storage/' . $provider->thumbnail) }}"
               alt="{{ $provider->shop_name }}"
               class="img-fluid rounded shadow-sm"
               style="max-height:250px; object-fit:cover;">
        </div>

        <!-- Info -->
        <div class="col-md-8">
          <h2 class="text-purple fw-bold">{{ $provider->shop_name }}</h2>
          <p class="text-muted"><i class="bi bi-eye"></i> {{ __('blade.Views') }}: {{ $provider->views }}</p>
          <p>{{ $provider->description }}</p>

          <p><strong>{{ __('blade.Category') }}:</strong> {{ $provider->category->name ?? __('blade.N/A') }}</p>
          <p><strong>{{ __('blade.Subcategory') }}:</strong> {{ $provider->subcategory->name ?? __('blade.N/A') }}</p>
          <p><strong>{{ __('blade.Location') }}:</strong> {{ $provider->state->name ?? '' }} - {{ $provider->city->name ?? '' }}</p>

          <!-- Tags -->
          <h5 class="mt-4 text-purple">{{ __('blade.Tags') }}:</h5>
          @if($provider->tags->count())
            <div class="d-flex flex-wrap gap-2 mt-2">
              @foreach($provider->tags as $tag)
                <a href="{{ route('providers.index', ['tag' => $tag->name]) }}"
                   class="badge rounded-pill badge-pill text-decoration-none">
                  {{ $tag->name }}
                </a>
              @endforeach
            </div>
          @else
            <p class="text-muted">{{ __('blade.No tags available') }}</p>
          @endif

          <!-- Contact -->
          <h5 class="mt-4 text-purple">{{ __('blade.Contact') }}:</h5>
          <div class="d-flex flex-wrap gap-2 mt-2">
            @if($provider->phone_number)
              <a href="tel:{{ $provider->phone_number }}"
                 class="btn btn-outline-secondary d-inline-flex align-items-center">
                 <i class="bi bi-telephone-fill me-2"></i> {{ __('blade.Call') }}
              </a>
            @endif
            @if($provider->whatsapp)
              <a href="https://wa.me/{{ $provider->whatsapp }}?text={{ urlencode(__('blade.WelcomeMessage')) }}"
                 target="_blank"
                 class="btn btn-outline-success">
                 <i class="bi bi-whatsapp"></i> WhatsApp
              </a>
            @endif
            @if($provider->facebook)
              <a href="{{ $provider->facebook }}" target="_blank" class="btn btn-outline-primary">
                <i class="bi bi-facebook"></i>
              </a>
            @endif
            @if($provider->instagram)
              <a href="{{ $provider->instagram }}" target="_blank" class="btn btn-outline-danger">
                <i class="bi bi-instagram"></i>
              </a>
            @endif
          </div>

          <!-- Back Button -->
          <div class="mt-4">
            <a href="{{ route('providers.index') }}" class="btn btn-custom-yellow">
              <i class="bi bi-arrow-left"></i> {{ __('blade.BackToProviders') }}
            </a>
          </div>
        </div>
      </div>

      <!-- Gallery -->
      @if($provider->gallery)
      <div class="mt-5">
        <h5 class="text-purple">{{ __('blade.Gallery') }}</h5>

        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner rounded shadow-sm" style="max-height:300px; overflow:hidden;">
            @foreach($provider->gallery as $index => $image)
              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $image) }}"
                     class="d-block w-100"
                     style="object-fit:cover; max-height:300px;"
                     alt="{{ __('blade.GalleryImage') }}">
              </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>

          <!-- Optional Thumbnails -->
          <div class="d-flex justify-content-center mt-2 gap-2">
            @foreach($provider->gallery as $index => $image)
              <img src="{{ asset('storage/' . $image) }}"
                   class="img-thumbnail"
                   style="width:60px; height:60px; object-fit:cover; cursor:pointer;"
                   data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $index }}">
            @endforeach
          </div>
        </div>
      </div>
    @endif

      <!-- Offers -->
      @if($provider->offers->where('status','active')->count())
        <div class="mt-5">
          <h5 class="text-purple">{{ __('blade.Offers') }}</h5>
          <div class="row g-3">
            @foreach($provider->offers->where('status','active') as $offer)
              <div class="col-md-4">
                <div class="card offer-card shadow-sm">
                  <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="{{ __('blade.OfferImage') }}">
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center mt-5">
  <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.AllRightsReserved') }}</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
