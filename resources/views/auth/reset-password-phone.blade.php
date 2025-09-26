<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('blade.reset_password_title') }} - FixMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #fffdf5; }
        .btn-custom-yellow { background-color: #fff3b0; color: #7e22ce; font-weight: 600; border: none; }
        .btn-custom-yellow:hover { background-color: #ffef9e; transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color:#7e22ce;">{{ __('blade.reset_password_heading') }}</h2>
            <p class="text-muted">{{ __('blade.reset_password_message') }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ url('/forgot-password/reset') }}" class="bg-white p-4 rounded shadow">
                    @csrf

                    <input type="hidden" name="phone_number" value="{{ $phone_number }}">

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('blade.new_password_label') }}</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('blade.confirm_password_label') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-custom-yellow w-100">{{ __('blade.reset_password_button') }}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
