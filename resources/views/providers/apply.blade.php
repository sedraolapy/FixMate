<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('blade.apply_title') }} - FixMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; }
    .text-purple { color: #7e22ce; }
    .btn-custom-yellow { background-color: #fff3b0; color: #7e22ce; font-weight: 600; border: none; border-radius: 8px; transition: all 0.3s ease; }
    .btn-custom-yellow:hover { background-color: #ffef9e; transform: scale(1.05); }
    .form-control, .form-select { border-radius: 8px; }
    .card-custom { border-radius: 1rem; box-shadow: 0 8px 24px rgba(0,0,0,0.08); background-color: #ffffff; padding: 2rem; }
  </style>
</head>
<body>

  <div class="container py-5">
    <div class="card card-custom mx-auto" style="max-width: 700px;">
      <h2 class="text-purple fw-bold text-center mb-4">{{ __('blade.become_provider') }}</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
      @endif

      @if (session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

      <form method="POST" action="{{ route('providers.apply') }}" enctype="multipart/form-data">
        @csrf

        <!-- Provider Name -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.provider_name') }} *</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.category') }} *</label>
          <select name="category_id" id="categorySelect" class="form-select" required>
            <option value="">{{ __('blade.select_category') }}</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- Subcategory -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.subcategory') }} *</label>
          <select name="sub_category_id" id="subcategorySelect" class="form-select" required>
            <option value="">{{ __('blade.select_subcategory') }}</option>
            @foreach($subcategories as $subcategory)
              <option value="{{ $subcategory->id }}" data-category="{{ $subcategory->category_id }}">
                {{ $subcategory->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Shop Name -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.shop_name') }} *</label>
          <input type="text" name="shop_name" class="form-control" required>
        </div>

        <!-- Image -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.thumbnail_image') }}</label>
          <input type="file" name="thumbnail" class="form-control">
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.description') }} *</label>
          <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <!-- State -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.state') }} *</label>
          <select name="state_id" id="stateSelect" class="form-select" required>
            <option value="">{{ __('blade.select_state') }}</option>
            @foreach($states as $state)
              <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- City -->
        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.city') }} *</label>
          <select name="city_id" id="citySelect" class="form-select" required>
            <option value="">{{ __('blade.select_city') }}</option>
            @foreach($cities as $city)
              <option value="{{ $city->id }}" data-state="{{ $city->state_id }}">
                {{ $city->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Contact Details -->
        <h5 class="text-purple fw-bold mt-4 mb-3">{{ __('blade.contact_details') }}</h5>

        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.phone_number') }} *</label>
          <input type="text" name="phone_number" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.whatsapp_number') }}</label>
          <input type="text" name="whatsapp" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.facebook_link') }}</label>
          <input type="url" name="facebook" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label text-purple">{{ __('blade.instagram_link') }}</label>
          <input type="url" name="instagram" class="form-control">
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-custom-yellow px-4 py-2">{{ __('blade.submit_application') }}</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Dynamic Filtering Script -->
  <script>
    // Category → Subcategory
    document.getElementById('categorySelect').addEventListener('change', function () {
      const selectedCategoryId = this.value;
      const subcategorySelect = document.getElementById('subcategorySelect');
      Array.from(subcategorySelect.options).forEach(option => {
        const belongsTo = option.getAttribute('data-category');
        option.style.display = (belongsTo === selectedCategoryId || option.value === '') ? 'block' : 'none';
      });
      subcategorySelect.value = '';
    });

    // State → City
    document.getElementById('stateSelect').addEventListener('change', function () {
      const selectedStateId = this.value;
      const citySelect = document.getElementById('citySelect');
      Array.from(citySelect.options).forEach(option => {
        const belongsTo = option.getAttribute('data-state');
        option.style.display = (belongsTo === selectedStateId || option.value === '') ? 'block' : 'none';
      });
      citySelect.value = '';
    });
  </script>

</body>
</html>
