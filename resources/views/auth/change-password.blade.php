<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.ChangePassword') }} - FixMate</title>
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
      transition: all 0.3s ease;
    }
    .btn-custom-yellow:hover {
      background-color: #ffef9e;
      transform: scale(1.05);
    }
    .form-section {
      background: linear-gradient(to bottom right, #ffffff, #fffaf0);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.05);
      max-width: 800px;
      margin: auto;
    }
    label {
      font-weight: 600;
      margin-bottom: 6px;
    }
    input:focus {
      border-color: #7e22ce;
      box-shadow: 0 0 0 0.2rem rgba(126, 34, 206, 0.25);
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
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('blade.Dashboard') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#">{{ __('blade.Features') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#">{{ __('blade.Contact') }}</a></li>
          <li class="nav-item"><a class="btn btn-custom-yellow" href="{{ route('register') }}">{{ __('blade.SignUp') }}</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Change Password Form -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold text-purple mb-4">{{ __('blade.ChangePassword') }}</h2>
      <p class="text-center mb-5">{{ __('blade.ChangePasswordDescription') }}</p>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}" class="form-section">
        @csrf
        @method('PUT')

        <div class="row g-4">
          <div class="col-md-6">
            <label for="current_password" class="form-label">{{ __('blade.CurrentPassword') }} <span class="text-danger">*</span></label>
            <div class="position-relative">
              <input type="password" id="current_password" name="current_password"
                     class="form-control pe-5 @error('current_password') is-invalid @enderror" required>
              <span class="position-absolute top-50 translate-middle-y end-0 me-3"
                    onclick="togglePassword('current_password', this)" style="cursor:pointer;">
                <i class="bi bi-eye-slash fs-5 text-purple" id="icon_current_password"></i>
              </span>
            </div>
            @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="new_password" class="form-label">{{ __('blade.NewPassword') }} <span class="text-danger">*</span></label>
            <div class="position-relative">
              <input type="password" id="new_password" name="password"
                     class="form-control pe-5 @error('new_password') is-invalid @enderror" required>
              <span class="position-absolute top-50 translate-middle-y end-0 me-3"
                    onclick="togglePassword('new_password', this)" style="cursor:pointer;">
                <i class="bi bi-eye-slash fs-5 text-purple" id="icon_new_password"></i>
              </span>
            </div>
            @error('new_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="password_confirmation" class="form-label">{{ __('blade.ConfirmNewPassword') }} <span class="text-danger">*</span></label>
            <div class="position-relative">
              <input type="password" id="password_confirmation" name="password_confirmation"
                     class="form-control pe-5 @error('password_confirmation') is-invalid @enderror" required>
              <span class="position-absolute top-50 translate-middle-y end-0 me-3"
                    onclick="togglePassword('password_confirmation', this)" style="cursor:pointer;">
                <i class="bi bi-eye-slash fs-5 text-purple" id="icon_password_confirmation"></i>
              </span>
            </div>
            @error('password_confirmation')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="text-center mt-5">
          <button type="submit" class="btn btn-custom-yellow px-5 py-2 rounded-pill">{{ __('blade.UpdatePassword') }}</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-center py-4">
    <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.AllRightsReserved') }}</p>
  </footer>

  <script>
    function togglePassword(fieldId, iconSpan) {
      const input = document.getElementById(fieldId);
      const icon = iconSpan.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
