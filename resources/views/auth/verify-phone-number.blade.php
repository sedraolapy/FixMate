<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.phone_verification_title') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdf5;
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
    .card-custom {
      border-radius: 0.75rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }
    .text-purple {
      color: #7e22ce;
    }
  </style>
</head>
<body>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-custom p-4 bg-white">
        <h4 class="mb-3 fw-bold text-purple text-center">
          {{ __('blade.verify_phone') }}
        </h4>
        <p class="text-muted small text-center">
          {{ __('blade.verification_message') }}
        </p>

        @if (session('status') == 'verification-link-sent')
          <div class="alert alert-success text-center">
            {{ __('blade.link_sent') }}
          </div>
        @endif

        <form method="POST" action="{{ route('verification.verify', ['customer_id' =>$customer->id]) }}">
          @csrf
          <div class="mb-3">
            <label class="form-label text-purple fw-semibold">{{ __('blade.verification_code') }}</label>
            <div class="d-flex gap-2 justify-content-center">
              <input type="text" name="code[]" maxlength="1" class="form-control text-center border border-purple" required>
              <input type="text" name="code[]" maxlength="1" class="form-control text-center border border-purple" required>
              <input type="text" name="code[]" maxlength="1" class="form-control text-center border border-purple" required>
              <input type="text" name="code[]" maxlength="1" class="form-control text-center border border-purple" required>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-custom-yellow">
              {{ __('blade.submit') }}
            </button>
            <a href="{{ route('login') }}" class="text-purple small text-decoration-underline">
              ← {{ __('blade.back_to_login') }}
            </a>
          </div>
        </form>

        <form method="POST" action="{{ route('verification.resend', ['customer_id' =>$customer->id]) }}" class="mt-4 text-center">
          @csrf
          <button type="submit" id="resend-button" class="btn btn-custom-yellow" disabled>
            {{ __('blade.resend_code') }}
          </button>
          <p class="small text-muted mt-2" id="resend-timer">
            {{ __('blade.resend_in', ['time' => '2:00']) }}
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Simple 2-minute countdown
  const resendBtn = document.getElementById('resend-button');
  const resendTimer = document.getElementById('resend-timer');
  let seconds = 120;

  const countdown = setInterval(() => {
    seconds--;
    const min = Math.floor(seconds / 60);
    const sec = seconds % 60;
    resendTimer.textContent = `{{ __('blade.resend_in', ['time' => ':time']) }}`.replace(':time', `${min}:${sec < 10 ? '0' : ''}${sec}`);
    if (seconds <= 0) {
      clearInterval(countdown);
      resendBtn.disabled = false;
      resendTimer.textContent = '';
    }
  }, 1000);

  document.querySelectorAll('input[name="code[]"]').forEach((input, index, inputs) => {
    input.addEventListener('input', () => {
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    });

    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '' && index > 0) {
        inputs[index - 1].focus();
      }
    });
  });
</script>
</body>
</html>
