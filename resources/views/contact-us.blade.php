<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.ContactUs') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
    }
    .text-purple { color: #7e22ce; }
    .form-section {
      max-width: 700px;
      margin: auto;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    }
    .btn-send {
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      border: none;
      padding: 10px 30px;
      border-radius: 30px;
      transition: all 0.3s ease;
    }
    .btn-send:disabled { background-color: #f0e6c0; cursor: not-allowed; }
  </style>
</head>
<body>

  <div class="container py-5">
    <h2 class="text-center fw-bold text-purple mb-4">{{ __('blade.ContactUs') }}</h2>

    @if (session('status'))
      <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}" class="form-section" id="contactForm">
        @csrf

        <div class="mb-3">
          <label for="user_name" class="form-label fw-semibold">{{ __('blade.YourName') }} <span class="text-danger">*</span></label>
          <input type="text" id="user_name" name="user_name"
                 class="form-control @error('user_name') is-invalid @enderror"
                 value="{{ old('user_name', auth('customer')->check() ? auth('customer')->user()->first_name.' '.auth('customer')->user()->last_name : '') }}" required>
          @error('user_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="phone_number" class="form-label fw-semibold">{{ __('blade.PhoneNumber') }} <span class="text-danger">*</span></label>
          <input type="text" id="phone_number" name="phone_number"
                 class="form-control @error('phone_number') is-invalid @enderror"
                 value="{{ old('phone_number', auth('customer')->check() ? auth('customer')->user()->phone_number : '') }}" required>
          @error('phone_number')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="message" class="form-label fw-semibold">{{ __('blade.Message') }} <span class="text-danger">*</span></label>
          <textarea id="message" name="message"
                    rows="5"
                    class="form-control @error('message') is-invalid @enderror"
                    required>{{ old('message') }}</textarea>
          @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-send" id="sendBtn" disabled>{{ __('blade.Send') }}</button>
        </div>
    </form>
  </div>

  <script>
    const form = document.getElementById('contactForm');
    const sendBtn = document.getElementById('sendBtn');

    form.addEventListener('input', () => {
      const name = form.user_name.value.trim();
      const phone = form.phone_number.value.trim();
      const message = form.message.value.trim();

      sendBtn.disabled = !(name && phone && message);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
