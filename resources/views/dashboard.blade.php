<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FixMate - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-purple: #7e22ce;
      --light-yellow: #ffef9e;
      --hover-yellow: #ffe066;
      --soft-bg: #fffdf5;
      --pill-bg: #f8f0ff;
      --pill-hover: #f3e8ff;
      --card-shadow: 0 8px 24px rgba(126, 34, 206, 0.08);
      --section-spacing: 6rem;
    }

    body {
      font-family: 'Inter', 'Segoe UI', sans-serif;
      background-color: var(--soft-bg);
      color: #333;
      line-height: 1.6;
    }

    /* Minimalist navbar styling */
    .navbar {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(8px);
      padding: 1rem 0;
      border-bottom: 1px solid rgba(126, 34, 206, 0.1);
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--primary-purple);
      letter-spacing: -0.5px;
    }

    .nav-link {
      font-weight: 500;
      padding: 0.5rem 1rem !important;
      color: #555;
      transition: all 0.2s ease;
      border-radius: 8px;
    }

    .nav-link:hover {
      color: var(--primary-purple);
      background-color: rgba(126, 34, 206, 0.05);
    }

    /* Simplified Search Bar */
    .search-container {
      position: relative;
      flex-grow: 1;
      max-width: 500px;
      margin: 0 2rem;
    }

    .search-input {
      width: 100%;
      padding: 0.85rem 1.5rem 0.85rem 3rem;
      border-radius: 12px;
      border: 1px solid #e9d5ff;
      background: white;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: var(--card-shadow);
    }

    .search-input:focus {
      outline: none;
      border-color: var(--primary-purple);
      box-shadow: 0 0 0 3px rgba(126, 34, 206, 0.15);
    }

    .search-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary-purple);
      z-index: 2;
    }

    .search-btn {
      position: absolute;
      right: 0.5rem;
      top: 50%;
      transform: translateY(-50%);
      border: none;
      background: var(--light-yellow);
      color: var(--primary-purple);
      border-radius: 10px;
      padding: 0.5rem 1.2rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .search-btn:hover {
      background: var(--hover-yellow);
    }

    /* Modern button styling */
    .btn-custom-yellow {
      background-color: var(--light-yellow);
      color: var(--primary-purple);
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 0.8rem 1.8rem;
      transition: all 0.3s ease;
      box-shadow: var(--card-shadow);
    }

    .btn-custom-yellow:hover {
      background-color: var(--hover-yellow);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(126, 34, 206, 0.15);
    }

    .text-purple {
      color: var(--primary-purple);
    }

    /* Modern section styling */
    .section-title {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 3rem;
      text-align: center;
      position: relative;
      color: #333;
    }

    .section-title:after {
      content: '';
      display: block;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-purple), #d8b4fe);
      margin: 1rem auto 0;
      border-radius: 2px;
    }

    /* Minimalist category styling */
    .category-scroll {
      display: flex;
      overflow-x: auto;
      gap: 1.5rem;
      padding: 1.5rem 0.5rem;
      scrollbar-width: thin;
    }

    .category-scroll::-webkit-scrollbar {
      height: 6px;
    }

    .category-scroll::-webkit-scrollbar-thumb {
      background: var(--primary-purple);
      border-radius: 10px;
    }

    .category-pill {
      flex: 0 0 auto;
      background-color: white;
      color: var(--primary-purple);
      border-radius: 16px;
      padding: 1.8rem 1.5rem;
      text-align: center;
      min-width: 180px;
      box-shadow: var(--card-shadow);
      transition: all 0.3s ease;
      border: 1px solid rgba(126, 34, 206, 0.08);
    }

    .category-pill:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(126, 34, 206, 0.12);
    }

    .category-pill img {
      width: 70px;
      height: 70px;
      object-fit: cover;
      border-radius: 16px;
      margin-bottom: 1rem;
      border: 2px solid var(--primary-purple);
      padding: 4px;
      background: white;
    }

    .category-pill h6 {
      margin: 0;
      font-weight: 600;
      font-size: 1rem;
      color: #333;
    }

    /* Section spacing */
    section {
      padding: var(--section-spacing) 0;
    }

    /* Minimalist footer */
    footer {
      background-color: white;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      padding: 3rem 0;
      margin-top: 4rem;
      text-align: center;
    }

    /* Modern card styling for sliders */
    .slider-card-single {
      width: 90%;
      max-width: 420px;
      margin: 0 auto;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .slider-card-single:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .slider-card-single img {
      width: 100%;
      height: 240px;
      object-fit: cover;
    }

    .slider-content-single {
      padding: 1.5rem;
      text-align: center;
    }

    .slider-content-single h3 {
      font-size: 1.4rem;
      margin-bottom: 0.5rem;
      color: #333;
      font-weight: 700;
    }

    /* Swiper customization */
    .swiper {
      padding: 3rem 0 5rem;
    }

    .swiper-button-next, .swiper-button-prev {
      background-color: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: var(--card-shadow);
      color: var(--primary-purple) !important;
    }

    .swiper-button-next:after, .swiper-button-prev:after {
      font-size: 1.4rem;
      font-weight: bold;
    }

    /* Dropdown styling */
    .dropdown-menu {
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(126, 34, 206, 0.1);
      padding: 0.5rem;
    }

    .dropdown-item {
      border-radius: 8px;
      padding: 0.7rem 1rem;
      transition: all 0.2s ease;
    }

    .dropdown-item:hover {
      background-color: var(--pill-bg);
    }

    /* Badge styling */
    .badge {
      border-radius: 8px;
      padding: 0.4em 0.7em;
      font-weight: 500;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
      .search-container {
        order: 3;
        max-width: 100%;
        margin: 1rem 0;
      }

      .navbar-collapse {
        flex-basis: 100%;
        flex-direction: column;
      }

      :root {
        --section-spacing: 4rem;
      }
    }

    .btn-outline-purple {
    color: #7e22ce;
    border: 1px solid #7e22ce;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    background-color: transparent;
    transition: 0.3s;
}

.btn-outline-purple:hover {
    background-color: #7e22ce;
    color: #fff;
}

.btn-outline-purple.active {
    background-color: #7e22ce;
    color: #fff;
}

    @media (max-width: 768px) {
      .section-title {
        font-size: 1.8rem;
      }

      .category-pill {
        min-width: 160px;
        padding: 1.5rem 1rem;
      }

      .btn-custom-yellow {
        padding: 0.7rem 1.5rem;
      }
    }
  </style>
</head>
<body>
<!-- Minimalist Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">FixMate</a>

      <!-- Search Bar -->
      <div class="search-container">
        <form class="search-form" method="GET" action="{{ route('dashboard') }}">
          <i class="bi bi-search search-icon"></i>
          <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Search for services, providers, categories..."
            id="searchInput"
            value="{{ request('search') }}"
          >
          <button type="submit" class="search-btn">{{ __('blade.Search') }}</button>
        </form>
      </div>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center gap-2">
          <li class="nav-item">
            <a class="nav-link fw-medium" href="{{ route('contact.us') }}">{{ __('blade.Contact') }}</a>
          </li>

          @auth('customer')
          <!-- Settings Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-gear-fill fs-5"></i> {{ __('blade.Settings') }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle"></i> {{ __('blade.View & Edit Profile') }}
                    </a>
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('password.change') }}">
                        <i class="bi bi-key"></i> {{ __('blade.Change Password') }}
                    </a>
                </li>

                {{-- 🔔 Notifications Toggle --}}
                <li>
                    <form action="{{ route('notifications.settings.update') }}" method="POST" class="dropdown-item m-0 p-0">
                        @csrf
                        @method('PATCH')

                        <div class="d-flex align-items-center justify-content-between px-3 py-2">
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-bell"></i> {{ __('blade.Notifications') }}
                            </span>

                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox"
                                       id="notificationsToggle"
                                       name="notifications_enabled" value="1"
                                       onchange="this.form.submit()"
                                       @checked(auth('customer')->user()->notifications_enabled)>
                            </div>
                        </div>
                    </form>
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('privacy.policy') }}">
                        <i class="bi bi-shield-lock"></i> {{ __('blade.Privacy Policy') }}
                    </a>
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('about.us') }}">
                        <i class="bi bi-info-circle"></i> {{ __('blade.About Us') }}
                    </a>
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('contact.us') }}">
                        <i class="bi bi-envelope"></i> {{ __('blade.Contact Us') }}
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 text-purple fw-bold" href="{{ route('providers.apply.form') }}">
                        <i class="bi bi-briefcase"></i> {{ __('blade.Become a Service Provider') }}
                    </a>
                </li>
            </ul>
        </li>

        @auth('customer')
          <li class="nav-item dropdown">
            <button class="nav-link btn btn-link d-flex align-items-center gap-1"
                    id="notificationsDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <i class="bi bi-bell fs-5"></i>
                <span class="badge bg-danger rounded-circle" id="notificationCount">{{ $unreadCount }}</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="min-width: 320px;">
                <li class="dropdown-header fw-bold text-purple">Notifications</li>
                <li><hr class="dropdown-divider"></li>

                @forelse(auth('customer')->user()->notifications()->with('notification')->latest()->take(10)->get() as $recipient)
                    @php
                        $notification = $recipient->notification; // the actual Notification model
                    @endphp

                    <li class="notification-item p-2 d-flex justify-content-between align-items-start @if(!$recipient->read_at) bg-light @endif">

                        {{-- Notification content --}}
                        <a href=""
                           class="d-flex flex-column text-decoration-none text-dark me-2">
                            <span class="fw-semibold">
                                {{ $notification->title ?? 'No Title' }}
                            </span>
                            <span class="text-muted">
                                {{ $notification->body ?? 'No Description' }}
                            </span>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </a>

                        {{-- Toggle Read/Unread --}}
                        <form action="{{ route('notifications.toggle', $recipient->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $recipient->read_at ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                {{ $recipient->read_at ? 'Mark Unread' : 'Mark Read' }}
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="p-2 text-muted text-center">No notifications</li>
                @endforelse

                <li><hr class="dropdown-divider"></li>
            </ul>


        </li>
        @endauth
          @endauth

          @guest('customer')
          <li class="nav-item ms-2">
            <a class="btn btn-custom-yellow px-3 py-2 fw-semibold" href="{{ route('register') }}">{{ __('blade.Sign Up') }}</a>
          </li>
          @endguest

          @auth('customer')
          <li class="nav-item ms-2">
            <button type="button" class="btn btn-custom-yellow px-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
              {{ __('blade.Log out') }}
            </button>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- Logout Modal -->
  @auth('customer')
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow-sm border-0">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="logoutModalLabel">{{ __('blade.Confirm Logout') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('blade.Close') }}"></button>
        </div>
        <div class="modal-body">
          {{ __('blade.Are you sure you want to log out?') }}
        </div>
        <div class="modal-footer border-0">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">{{ __('blade.Yes, log out') }}</button>
          </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('blade.No') }}</button>
        </div>
      </div>
    </div>
  </div>
  @endauth

  <!-- Hero Swiper Slider -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
            @php
                $hasProvider = $slider->serviceProvider !== null;
                $link = $hasProvider ? route('providers.show', $slider->serviceProvider->id) : null;
            @endphp
            <div class="swiper-slide">
                @if ($hasProvider)
                    <a href="{{ $link }}" class="d-block text-decoration-none text-dark">
                @endif
                    <div class="slider-card-single">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="w-100" alt="{{ __($slider->title) }}">
                        <div class="slider-content-single">
                            <h3 class="text-purple fw-bold">{{ __('blade.' . $slider->title) }}</h3>
                        </div>
                    </div>
                @if ($hasProvider) </a> @endif
            </div>
        @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Categories Section -->
  <section>
    <div class="container">
      <h2 class="section-title">{{ __('blade.Available Categories') }}</h2>

      @if($categories->count())
        <div class="category-scroll">
          @foreach ($categories->take(7) as $category)
            <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
              <div class="category-pill">
                <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                <h6 class="mt-2">{{ $category->name }}</h6>
              </div>
            </a>
          @endforeach
        </div>
        <div class="text-center mt-5">
          <a href="{{ route('categories.index') }}" class="btn btn-custom-yellow px-4 py-2">{{ __('blade.See All Categories') }}</a>
        </div>
      @else
        <p class="text-center text-muted">{{ __('blade.No categories available at the moment.') }}</p>
      @endif

      @auth('customer')
        <div class="text-center mt-4">
          <a href="{{ route('subcategories.index') }}" class="btn btn-outline-purple px-4 py-2">{{ __('blade.View All Subcategories') }}</a>
        </div>
      @endauth
    </div>
  </section>

  <!-- Service Providers Section -->
  <section>
    <div class="container">
      <h2 class="section-title">{{ __('blade.Top Service Providers') }}</h2>

      @if($providers->count())
        <div class="category-scroll">
          @foreach ($providers as $provider)
            @auth('customer')
              <a href="{{ route('providers.show', $provider->id) }}" class="text-decoration-none">
            @endif
            <div class="category-pill">
                <img src="{{ asset('storage/' . $provider->thumbnail) }}" alt="{{ $provider->shop_name }}">
                <h6 class="mt-2">{{ $provider->shop_name }}</h6>
                <p class="small text-muted mb-2">Views: {{ $provider->views }}</p>
                <div class="mt-2">
                    @foreach($provider->tags as $tag)
                        <span class="badge bg-light text-purple border me-1">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            @auth('customer')
              </a>
            @endauth
          @endforeach
        </div>

        <div class="text-center mt-5">
          <a href="{{ route('providers.index') }}" class="btn btn-custom-yellow px-4 py-2">{{ __('blade.See All Service Providers') }}</a>
        </div>
      @else
        <p class="text-center text-muted">{{ __('blade.No service providers available at the moment.') }}</p>
      @endif
    </div>
  </section>

  <!-- Offers Section -->
  <section>
    <div class="container">
      <h2 class="section-title">{{ __('blade.Latest Offers') }}</h2>

      @if($offers->count())
        <div class="category-scroll">
          @foreach ($offers as $offer)
            @auth('customer')
              <a href="{{ route('providers.show', $offer->serviceProvider->id) }}" class="text-decoration-none">
            @endif
            <div class="category-pill">
              <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}">
              <h6 class="mt-2">{{ $offer->title }}</h6>
              <p class="small text-muted mb-0">{{ $offer->serviceProvider->shop_name }}</p>
            </div>
            @auth('customer')
              </a>
            @endauth
          @endforeach
        </div>

        <div class="text-center mt-5">
          <a href="{{ route('offers.index') }}" class="btn btn-custom-yellow px-4 py-2">{{ __('blade.Show All Offers') }}</a>
        </div>
      @else
        <p class="text-center text-muted">{{ __('blade.No offers available at the moment.') }}</p>
      @endif
    </div>
  </section>

  <!-- Government Entities Section -->
  <section>
    <div class="container">
      <h2 class="section-title">{{ __('blade.Government Entities') }}</h2>
      <div class="text-center mt-4">
        <a href="{{ route('entities.index') }}" class="btn btn-custom-yellow px-4 py-2">{{ __('blade.Show All Government Entities') }}</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p class="mb-0 text-purple">&copy; 2025 {{ __('blade.FixMate. All rights reserved.') }}</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper('.mySwiper', {
      loop: true,
      autoplay: { delay: 4000, disableOnInteraction: false },
      slidesPerView: 1,
      spaceBetween: 30,
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });

    document.addEventListener('DOMContentLoaded', function() {
      // Prevent dropdown from closing when clicking inside forms
      const dropdownForms = document.querySelectorAll('.dropdown-menu form');
      dropdownForms.forEach(form => {
          form.addEventListener('click', function(e) {
              e.stopPropagation();
          });
      });
    });
  </script>
</body>
</html>