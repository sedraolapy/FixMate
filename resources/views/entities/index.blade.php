<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.GovernmentEntities') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #fffdf5; }
    .text-purple { color: #7e22ce; }
    .btn-custom-yellow {
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .btn-custom-yellow:hover { background-color: #ffef9e; transform: scale(1.05); }
    .entity-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 1.5rem;
      margin-bottom: 1rem;
      text-align: center;
    }
    .entity-card img { max-width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem; }
    .phone-link {
      display: inline-block;
      margin: 4px;
      padding: 8px 12px;
      background-color: #007bff;
      color: #fff;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .phone-link:hover { background-color: #0056b3; }
    footer { background-color: #fff; padding: 1rem 0; border-top: 1px solid #eee; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-purple" href="{{ route('dashboard') }}">FixMate</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('blade.Dashboard') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact.us') }}">{{ __('blade.Contact') }}</a></li>

      </ul>
    </div>
  </div>
</nav>

<!-- Government Entities Section -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center text-purple fw-bold mb-4">{{ __('blade.GovernmentEntities') }}</h2>

    <!-- Search Form -->
    <form action="{{ route('entities.index') }}" method="GET" class="d-flex mb-4 justify-content-center">
      <input type="text" name="search" class="form-control me-2" placeholder="{{ __('blade.SearchByEntityName') }}" value="{{ request('query') }}">
      <button type="submit" class="btn btn-primary">{{ __('blade.Search') }}</button>
    </form>

    @if($entities->count())
      <div class="row">
        @foreach($entities as $entity)
          <div class="col-md-6">
            <div class="entity-card">
              <img src="{{ asset('storage/' . $entity->image) }}" alt="{{ $entity->getTranslation('name', app()->getLocale()) }}">
              <h5 class="text-purple fw-semibold">{{ $entity->getTranslation('name', app()->getLocale()) }}</h5>

              @php
                $numbers = is_string($entity->phone_numbers) ? json_decode($entity->phone_numbers, true) : $entity->phone_numbers;
              @endphp

              @if(is_array($numbers))
                @foreach($numbers as $number)
                  <a href="tel:{{ $number['number'] }}" class="phone-link">📞 {{ __('blade.Call') }}</a>
                @endforeach
              @else
                <p>{{ __('blade.NoPhoneNumbers') }}</p>
              @endif

              @if($entity->facebook)
                <a href="{{ $entity->facebook }}" target="_blank" rel="noopener noreferrer" class="me-2">
                  <i class="fab fa-facebook-f text-primary fs-5"></i>
                </a>
              @endif
              @if($entity->instagram)
                <a href="{{ $entity->instagram }}" target="_blank" rel="noopener noreferrer">
                  <i class="fab fa-instagram text-danger fs-5"></i>
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center text-muted">{{ __('blade.NoEntitiesAvailable') }}</p>
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
