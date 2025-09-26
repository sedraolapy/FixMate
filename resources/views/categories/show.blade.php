<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $category->name }} - FixMate</title>
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
    .subcategory-card img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 0.5rem;
    }
    .subcategory-card h6 {
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

    <!-- Category Info -->
    <div class="card shadow-sm mb-4">
      <div class="card-body text-center">
        <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}" class="rounded-circle mb-3" style="width: 80px; height: 80px;">
        <h2 class="text-purple fw-bold">{{ $category->name }}</h2>
        @if($category->description)
          <p class="mt-3 text-muted">{{ $category->description }}</p>
        @else
          <p class="mt-3 text-muted">No description available for this category.</p>
        @endif
      </div>
    </div>

    <!-- Subcategories -->
    <h4 class="text-purple fw-bold mb-3">Subcategories</h4>

    @if($category->subcategories->count())
      <div class="row">
        @foreach($category->subcategories as $subcategory)
          <div class="col-md-3 col-sm-6 mb-4">
            <a href="{{ route('subcategories.show', $subcategory->id) }}" class="text-decoration-none">
                <div class="card shadow-sm text-center p-3 subcategory-card h-100">
                  <img src="{{ asset('storage/' . $subcategory->thumbnail) }}" alt="{{ $subcategory->name }}">
                  <h6 class="text-purple">{{ $subcategory->name }}</h6>
                </div>
              </a>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-muted">No subcategories available for this category.</p>
    @endif
  </div>

  <footer class="bg-white text-center py-4">
    <p class="mb-0" style="color:#7e22ce;">&copy; 2025 FixMate. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>