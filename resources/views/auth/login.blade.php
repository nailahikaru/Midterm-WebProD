<x-layout title="Login — UKM Genshin">
  <section>
    <div class="container" style="max-width: 28rem; padding-top: 3rem;">
      <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
          <h2 class="fw-semibold text-center mb-4">Login</h2>

          <form method="POST" action="{{ route('register') }}"
      onsubmit="this.querySelector('button[type=submit]').disabled = true">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}"
                     class="form-control @error('email') is-invalid @enderror" required autofocus>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password"
                     class="form-control @error('password') is-invalid @enderror" required>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>

          <p class="text-center mt-3 mb-0">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
          </p>
        </div>
      </div>
    </div>
  </section>
</x-layout>