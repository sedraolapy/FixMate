<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.MyProfile') }} - FixMate</title>
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
    .form-section {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    label {
      font-weight: 600;
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

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <!-- Profile Form -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold text-purple mb-4">{{ __('blade.MyProfile') }}</h2>
      <p class="text-center mb-5">{{ __('blade.ProfileDescription') }}</p>

      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-section">
        @csrf
        @method('PUT')

        <div class="row g-4">
          <div class="col-md-6">
            <label for="first_name" class="form-label">{{ __('blade.FirstName') }} <span class="text-danger">*</span></label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
          </div>

          <div class="col-md-6">
            <label for="last_name" class="form-label">{{ __('blade.LastName') }} <span class="text-danger">*</span></label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
          </div>

          <div class="col-md-6">
            <label for="phone" class="form-label">{{ __('blade.PhoneNumber') }}</label>
            <input type="text" id="phone" class="form-control" value="{{ $user->phone_number }}" disabled>
          </div>

          <div class="col-md-6">
            <label for="image" class="form-label">{{ __('blade.ProfileImage') }}</label>

            @if($user->image)
              <div class="mb-3">
                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ __('blade.ProfileImage') }}" class="img-thumbnail" style="max-height: 150px;">
              </div>
            @endif

            <input type="file" id="image" name="image" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label" for="state">{{ __('blade.State') }}</label>
            <select class="form-select" id="state" name="state_id">
                <option disabled>{{ __('blade.SelectState') }}</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ old('state_id', $user->state_id) == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
            @error('state_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="city">{{ __('blade.City') }}</label>
            <select class="form-select" id="city" name="city_id">
                <option disabled>{{ __('blade.SelectCity') }}</option>
                @if($user->city)
                    <option value="{{ $user->city->id }}" selected>{{ $user->city->name }}</option>
                @endif
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
                    citySelect.innerHTML = `<option disabled>{{ __('blade.SelectCity') }}</option>`;
                    data.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                });
        });
        </script>

        </div>

        <div class="text-center mt-5">
            <button type="submit" id="updateBtn" class="btn btn-custom-yellow px-5 py-2 rounded-pill" disabled>{{ __('blade.UpdateProfile') }}</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white text-center py-4">
    <p class="mb-0 text-purple">&copy; 2025 FixMate. {{ __('blade.AllRightsReserved') }}</p>
  </footer>

  <script>
    const form = document.querySelector('form');
    const updateBtn = document.getElementById('updateBtn');
    let isChanged = false;

    form.querySelectorAll('input, select').forEach(element => {
      element.addEventListener('change', () => {
        if (!isChanged) {
          isChanged = true;
          updateBtn.disabled = false;
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
