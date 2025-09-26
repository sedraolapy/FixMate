<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('blade.verify_code_title') }} - FixMate</title>
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
            <h2 class="fw-bold" style="color:#7e22ce;">{{ __('blade.enter_verification_code') }}</h2>
            <p class="text-muted">{{ __('blade.check_whatsapp_message') }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.code') }}" class="bg-white p-4 rounded shadow">
                    @csrf

                    <input type="hidden" name="phone_number" value="{{ old('phone_number', request('phone_number')) }}">

                    <div class="mb-3">
                        <label for="verification_code" class="form-label">{{ __('blade.verification_code_label') }}</label>
                        <input type="text" name="verification_code" id="verification_code" class="form-control" required>
                        @error('verification_code')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-custom-yellow w-100">{{ __('blade.verify_code_button') }}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
