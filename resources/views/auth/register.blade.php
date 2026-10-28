<x-layout title="Register — UKM Genshin">
  <section>
    <div class="container" style="max-width: 28rem; padding-top: 3rem;">
      <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
          <h2 class="fw-semibold text-center mb-4">Daftar</h2>

          <form method="POST" action="{{ route('register') }}"
      onsubmit="this.querySelector('button[type=submit]').disabled = true">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}"
                     class="form-control @error('name') is-invalid @enderror" required autofocus>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}"
                     class="form-control @error('email') is-invalid @enderror" required>
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

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi password</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                     class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar</button>
          </form>

          <p class="text-center mt-3 mb-0">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
          </p>
        </div>
      </div>
    </div>
  </section>
</x-layout>