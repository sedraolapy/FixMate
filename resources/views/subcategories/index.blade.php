<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FixMate - Subcategories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary-purple: #7e22ce;
      --light-yellow: #fff3b0;
      --hover-yellow: #ffef9e;
      --soft-bg: #fffdf5;
      --card-bg: #f9f5ff;
      --card-hover: #f3e8ff;
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

    .hero {
      background: linear-gradient(to right, #a855f7, var(--primary-purple));
      color: white;
      padding: 80px 0;
      text-align: center;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .subcategory-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 1.5rem;
    }

    .subcategory-card {
      background-color: var(--card-bg);
      border-radius: 12px;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      text-decoration: none;
      color: inherit;
    }

    .subcategory-card:hover {
      background-color: var(--card-hover);
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .subcategory-card img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 0.75rem;
      border: 2px solid var(--primary-purple);
    }

    .subcategory-card h6 {
      font-size: 1rem;
      font-weight: 600;
      margin: 0;
    }

    footer {
      background-color: white;
      border-top: 1px solid #eee;
      padding: 1rem 0;
    }

    @media (max-width: 576px) {
      .hero h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-purple" href="#">FixMate</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Explore Subcategories</h1>
      <p class="mt-2">Find services tailored to your needs</p>
    </div>
  </section>

  <div class="container mt-4">
    <form method="GET" action="{{ route('subcategories.index') }}" class="row g-3 align-items-center mb-4">
      <div class="col-md-6">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by subcategory or tag name">
      </div>

      <div class="col-md-auto">
        <button type="submit" class="btn btn-custom-yellow">
          <i class="bi bi-search"></i> Search
        </button>
      </div>

      @if(request('search'))
        <div class="col-md-auto">
          <a href="{{ route('subcategories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Reset
          </a>
        </div>
      @endif
    </form>
  </div>

  
  <!-- Subcategories Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="mb-4 fw-semibold text-center text-purple">Available Subcategories</h2>

      @if($subcategories->count())
        <div class="subcategory-grid">
          @foreach ($subcategories as $subcategory)
            <a href="{{ route('subcategories.show', $subcategory->id) }}" class="subcategory-card">
              <img src="{{ asset('storage/' . $subcategory->thumbnail) }}" alt="{{ $subcategory->name }}">
              <h6>{{ $subcategory->name }}</h6>
            </a>
          @endforeach
        </div>
      @else
        <p class="text-center text-muted">No subcategories available at the moment.</p>
      @endif
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
    <p class="mb-0 text-purple">&copy; 2025 FixMate. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>