<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FixMate - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
    }
    .hero {
      background: linear-gradient(to right, #a855f7, #7e22ce);
      color: white;
      padding: 120px 0;
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
    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .cta {
      background-color: #fff3b0;
      color: #581c87;
      padding: 100px 0;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" style="color:#7e22ce;" href="#">FixMate</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="btn btn-custom-yellow" href="#">Sign Up</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Shine Bright With Smart Services</h1>
      <p class="lead mt-3 mb-4">Empowering you with reliable support and vibrant solutions.</p>
      <a href="#" class="btn btn-custom-yellow btn-lg rounded-pill shadow">Join Us Now</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-4 fw-semibold" style="color:#7e22ce;">Why Choose Us</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow feature-card">
            <i class="bi bi-lightning-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">Quick Results</h5>
            <p>Time-saving solutions that don’t sacrifice quality.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow feature-card">
            <i class="bi bi-shield-lock-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">Secure & Trustworthy</h5>
            <p>Privacy-first service with complete peace of mind.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow feature-card">
            <i class="bi bi-chat-dots-fill display-6 text-warning"></i>
            <h5 class="mt-3 fw-bold">Dedicated Support</h5>
            <p>Round-the-clock help from caring professionals.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta text-center">
    <div class="container">
      <h2 class="display-5 fw-bold">Let's Build Something Brilliant Together</h2>
      <p class="lead mt-3 mb-4">We're ready when you are — your journey starts here.</p>
      <a href="#" class="btn btn-light btn-lg text-purple fw-semibold rounded-pill shadow" style="color:#7e22ce;">Sign Up Today</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-center py-4">
    <p class="mb-0" style="color:#7e22ce;">&copy; 2025 ServicePro. All rights reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>