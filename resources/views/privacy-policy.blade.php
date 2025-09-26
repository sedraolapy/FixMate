<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.PrivacyPolicy') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #fffdf5, #f8f0ff);
      color: #333;
    }

    .text-purple {
      color: #7e22ce;
    }

    .policy-section {
      max-width: 900px;
      margin: 2rem auto;
      padding: 30px 25px;
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(126, 34, 206, 0.1);
      line-height: 1.7;
      font-size: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .policy-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 36px rgba(126, 34, 206, 0.15);
    }

    h2 {
      color: #7e22ce;
      font-size: 2rem;
    }

    .alert-warning {
      background-color: #fff3b0;
      color: #7e22ce;
      border: none;
      font-weight: 600;
    }

    p {
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h2 class="text-center fw-bold mb-4 text-purple">{{ __('blade.PrivacyPolicy') }}</h2>

    @forelse ($privacy_policies as $policy)
      <div class="policy-section mb-4">
        {!! nl2br(e($policy->content)) !!}
      </div>
    @empty
      <div class="alert alert-warning text-center">
        {{ __('blade.NoPrivacyPolicy') }}
      </div>
    @endforelse
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
