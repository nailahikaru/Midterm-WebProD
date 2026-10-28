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
            <a class="nav-link {{ request()->is('announcements*') ? 'active' : '' }}" href="{{ route('announcements.index') }}">Pengumuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('portfolios*') ? 'active' : '' }}" href="{{ route('portfolios.index') }}">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}">Event</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @guest
            <li class="nav-item">
              <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
            </li>
          @endguest

          @auth
            <li class="nav-item">
              <a class="nav-link {{ request()->is('schedule*') ? 'active' : '' }}" href="{{ route('schedule.index') }}">Jadwal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('presence*') ? 'active' : '' }}" href="{{ route('presence.list') }}">Presensi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('cash*') ? 'active' : '' }}" href="{{ route('cash.index') }}">Kas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link">Logout</button>
              </form>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>