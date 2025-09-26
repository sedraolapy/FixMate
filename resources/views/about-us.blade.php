<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.AboutUs') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #fffdf5, #f8f0ff);
      color: #333;
    }

    .text-purple {
      color: #7e22ce;
    }

    .about-section {
      max-width: 900px;
      margin: 2rem auto;
      padding: 30px 25px;
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(126, 34, 206, 0.1);
      line-height: 1.8;
      font-size: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 36px rgba(126, 34, 206, 0.15);
    }

    .contact-icons a {
      font-size: 1.8rem;
      margin-right: 15px;
      color: #7e22ce;
      transition: transform 0.2s ease;
    }

    .contact-icons a:hover {
      transform: scale(1.2);
    }

    .call-button {
      display: inline-block;
      background-color: #fff3b0;
      color: #7e22ce;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .call-button:hover {
      background-color: #ffef9e;
      transform: scale(1.05);
    }

    h2, h5 {
      color: #7e22ce;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h2 class="text-center fw-bold mb-4 text-purple">{{ __('blade.AboutUs') }}</h2>

    @forelse ($about_us as $info)
      <div class="about-section mb-4">
        <p>{{ $info->about_us }}</p>

        <h5 class="mt-4 text-purple">{{ __('blade.ContactUs') }}</h5>

        <!-- Call Button -->
        <a href="tel:{{ $info->phone_number }}" class="call-button">{{ __('blade.CallUs') }}</a>

        <!-- Social Icons -->
        <div class="contact-icons mt-4">
          @if ($info->facebook)
            <a href="{{ $info->facebook }}" target="_blank" aria-label="Facebook">
              <i class="bi bi-facebook"></i>
            </a>
          @endif
          @if ($info->instagram)
            <a href="{{ $info->instagram }}" target="_blank" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
          @endif
        </div>
      </div>
    @empty
      <div class="alert alert-warning text-center">
        {{ __('blade.NoAboutInfo') }}
      </div>
    @endforelse
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
