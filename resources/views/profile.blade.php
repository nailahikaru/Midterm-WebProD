<x-layout title="Profile — UKM Genshin">
  <section>
    <div class="container" style="max-width: 32rem; padding-top: 3rem;">
      <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
          <h2 class="fw-semibold text-center mb-4">Profil Saya</h2>

          <dl class="row mb-0">
            <dt class="col-sm-4">Nama</dt>
            <dd class="col-sm-8">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-4">Email</dt>
            <dd class="col-sm-8">{{ Auth::user()->email }}</dd>
          </dl>
        </div>
      </div>
    </div>
  </section>
</x-layout>