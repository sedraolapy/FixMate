<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.login_title') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #fdf6ff, #fffdf5);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-custom {
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      padding: 2rem;
      background-color: #ffffff;
      width: 100%;
      max-width: 480px;
    }

    .text-purple {
      color: #7e22ce;
    }

    .btn-custom-yellow {
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .btn-custom-yellow:hover {
      background-color: #ffef9e;
      transform: scale(1.05);
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-outline-purple {
      border: 2px solid #7e22ce;
      color: #7e22ce;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .btn-outline-purple:hover {
      background-color: #f3e8ff;
    }

    .provider-link {
      margin-top: 2rem;
      text-align: center;
    }

    .alert {
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="card card-custom">
    <h4 class="mb-4 fw-bold text-purple text-center">{{ __('blade.login_heading') }}</h4>

    @if (session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (session('info'))
      <div class="alert alert-info text-center">{{ session('info') }}</div>
    @endif

    @if (session('status'))
      <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0 small">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="phone_number" class="form-label text-purple fw-semibold">{{ __('blade.phone_number') }}</label>
        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required autofocus>
        @error('phone_number')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label text-purple fw-semibold">{{ __('blade.password') }}</label>
        <div class="input-group">
          <input type="password" id="password" name="password" class="form-control" required>
          <button type="button" class="btn btn-outline-secondary" id="togglePassword">
            <i class="bi bi-eye-fill" id="toggleIcon"></i>
          </button>
        </div>
        @error('password')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>


      <div class="d-flex justify-content-between align-items-center mb-3">
        @if (Route::has('password.request'))
          <a class="text-purple small text-decoration-underline" href="{{ route('password.request') }}">
            {{ __('blade.forgot_password') }}
          </a>
        @endif

        <button type="submit" class="btn btn-custom-yellow px-4">{{ __('blade.login_button') }}</button>
      </div>
    </form>

    <div class="provider-link">
      <a href="{{ route('providers.apply.form') }}" class="btn btn-outline-purple w-100">
        {{ __('blade.become_provider') }}
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePassword.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggleIcon.classList.toggle('bi-eye-fill');
      toggleIcon.classList.toggle('bi-eye-slash-fill');
    });
  </script>

</body>
</html>
