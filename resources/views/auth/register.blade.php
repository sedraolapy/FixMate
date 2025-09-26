<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ __('blade.FixMate - Register') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
    }
    .register-container {
      max-width: 600px;
      margin: auto;
      padding: 60px 20px;
    }
    .form-label {
      font-weight: 600;
      color: #581c87;
    }
    .btn-custom-purple {
      background-color: #7e22ce;
      color: white;
      font-weight: 600;
    }
    .btn-custom-purple:hover {
      background-color: #6b21a8;
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
    </div>
  </nav>

  <!-- Register Form -->
  <div class="register-container bg-white rounded shadow mt-5 p-4">

    <h2 class="text-center fw-bold mb-4" style="color:#7e22ce;">
      {{ __('blade.Create Your Account') }}
    </h2>

    <form method="POST" action="{{ route('customer.register') }}">
        @csrf
      <div class="mb-3">
        <label class="form-label" for="firstName">{{ __('blade.First Name') }}</label>
        <input type="text" class="form-control" id="firstName"  name="first_name" />
        @error('first_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="lastName">{{ __('blade.Last Name') }}</label>
        <input type="text" class="form-control" id="lastName"  name="last_name" />
        @error('last_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="phone">{{ __('blade.Phone Number') }}</label>
        <input type="tel" class="form-control" id="phone" name="phone_number"  />
        @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="state">{{ __('blade.State') }}</label>
        <select class="form-select" id="state" name="state_id" >
          <option selected disabled>{{ __('blade.Select State') }}</option>
          @foreach ($states as $state)
            <option value="{{ $state->id }}">{{ $state->name }}</option>
          @endforeach
        </select>
        @error('state_id')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="city">{{ __('blade.City') }}</label>
        <select class="form-select" id="city" name="city_id" >
          <option selected disabled>{{ __('blade.Select City') }}</option>
        </select>
        @error('city_id')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <script>
        document.getElementById('state').addEventListener('change', function () {
          const stateId = this.value;
          fetch(`/cities/${stateId}`)
            .then(response => response.json())
            .then(data => {
              const citySelect = document.getElementById('city');
              citySelect.innerHTML = '<option selected disabled>{{ __("blade.Select City") }}</option>';
              data.forEach(city => {
                citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
              });
            });
        });
      </script>

      <div class="mb-3">
        <label class="form-label" for="password">{{ __('blade.Password') }}</label>
        <input type="password" class="form-control" id="password"  name="password" />
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label class="form-label" for="confirmPassword">{{ __('blade.Confirm Password') }}</label>
        <input type="password" class="form-control" id="confirmPassword"  name="password_confirmation"/>
      </div>

      <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="terms" name="terms" >
        @error('terms')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <label class="form-check-label" for="terms">
          {{ __('blade.I accept the') }} <a href="#">{{ __('blade.Terms and Conditions') }}</a>
        </label>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-custom-purple btn-lg rounded-pill">
          {{ __('blade.Register') }}
        </button>
      </div><br>

      <div class="text-center">
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
          <i class="bi bi-arrow-left-circle"></i> {{ __('blade.Back to Sign In') }}
        </a>
      </div>

    </form>
  </div>

  <!-- Footer -->
  <footer class="bg-white text-center py-4 mt-5">
    <p class="mb-0" style="color:#7e22ce;">
      &copy; 2025 FixMate. {{ __('blade.All rights reserved.') }}
    </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
