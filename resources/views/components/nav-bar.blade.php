 
 <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
 
 <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('image/logo.webp') }}" alt="Logo UKM Genshin" width="40" height="40" class="align-text-top">
        <span>UKM Genshin <i class="bi bi-stars"></i></span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarNav" aria-controls="navbarNav"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('profile-ukm') ? 'active' : '' }}" href="{{ url('/profile-ukm') }}">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>