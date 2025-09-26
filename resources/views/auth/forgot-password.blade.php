<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('blade.forgot_password_title') }} - FixMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #fffdf5; }
        .btn-custom-yellow { background-color: #fff3b0; color: #7e22ce; font-weight: 600; border: none; }
        .btn-custom-yellow:hover { background-color: #ffef9e; transform: scale(1.05); }
            .btn-back-login {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background-color: #f3f4f6; /* Light gray background */
        color: #7e22ce;            /* Purple text */
        font-weight: 600;
        border: 2px solid #7e22ce;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .btn-back-login:hover {
        background-color: #7e22ce;  /* Purple background on hover */
        color: #fff;                 /* White text */
        transform: translateY(-2px);
    }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color:#7e22ce;">{{ __('blade.forgot_password_heading') }}</h2>
            <p class="text-muted">{{ __('blade.forgot_password_message') }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('send.code') }}" class="bg-white p-4 rounded shadow">
                    @csrf

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">{{ __('blade.phone_number_label') }}</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                        @error('phone_number')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-custom-yellow w-100">{{ __('blade.send_code_button') }}</button>

                    <!-- Back to Login -->
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn-back-login">
                            {{ __('blade.back_to_login') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
