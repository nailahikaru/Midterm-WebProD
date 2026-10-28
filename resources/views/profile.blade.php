<x-layout title="Profile — UKM Genshin">
  <section>
    <div class="container" style="max-width: 32rem; padding-top: 3rem;">
      <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
          <h2 class="fw-semibold text-center mb-4">Profil Saya</h2>

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" id="name" name="name"
                     value="{{ old('name', Auth::user()->name) }}"
                     class="form-control @error('name') is-invalid @enderror" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email"
                     value="{{ old('email', Auth::user()->email) }}"
                     class="form-control @error('email') is-invalid @enderror" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-layout>