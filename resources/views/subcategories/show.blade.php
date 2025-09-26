<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $sub_category->name }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
    }
    .text-purple {
      color: #7e22ce;
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
    .service-card img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 0.5rem;
    }
    .service-card h6 {
      font-size: 0.95rem;
      font-weight: 600;
      margin: 0;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <a href="{{ route('dashboard') }}" class="btn btn-light text-purple fw-semibold mb-4">
      <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>

    <!-- Subcategory Info -->
    <div class="card shadow-sm mb-4">
      <div class="card-body text-center">
        <img src="{{ asset('storage/' . $sub_category->thumbnail) }}" alt="{{ $sub_category->name }}" class="rounded-circle mb-3" style="width: 80px; height: 80px;">
        <h2 class="text-purple fw-bold">{{ $sub_category->name }}</h2>

        <p class="text-muted mb-1">
          <strong>Category:</strong>
          {{ $sub_category->category->name ?? 'Unassigned' }}
        </p>

        <p class="text-muted mb-3">
          <strong>Status:</strong>
          {{ ucfirst($sub_category->status->value) }}
        </p>

        @if($sub_category->description)
          <p class="text-muted">{{ $sub_category->description }}</p>
        @else
          <p class="text-muted">No description available for this subcategory.</p>
        @endif
      </div>
    </div>

   <!-- Services -->
<h4 class="text-purple fw-bold mb-3">Service Providers</h4>

@if($sub_category->serviceProviders && $sub_category->serviceProviders->count())
  <div class="row">
    @foreach($sub_category->serviceProviders as $provider)
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card shadow-sm text-center p-3 service-card h-100">
          <img src="{{ asset('storage/' . $provider->thumbnail) }}" alt="{{ $provider->name }}">
          <h6 class="text-purple">{{ $provider->name }}</h6>
          <p class="text-muted small mb-1">{{ $provider->shop_name }}</p>
          <p class="text-muted small">{{ Str::limit($provider->description, 60) }}</p>
          <a href="" class="btn btn-sm btn-custom-yellow mt-2">
            <i class="bi bi-eye"></i> View Details
          </a>
        </div>
      </div>
    @endforeach
  </div>
@else
  <p class="text-muted">No service providers available for this subcategory.</p>
@endif



  <footer class="bg-white text-center py-4">
    <p class="mb-0" style="color:#7e22ce;">&copy; 2025 FixMate. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>