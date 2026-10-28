@extends('layouts.page-c')
@section('title', 'Portofolio Karya')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-semibold mb-0">Portofolio Karya</h1>
    @auth
      <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah
      </a>
    @endauth
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row g-4">
    @forelse ($portfolios as $portfolio)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card card-glass h-100 overflow-hidden">

          <div class="d-flex align-items-center gap-2 p-3">
            <div class="avatar-circle">
              {{ strtoupper(substr($portfolio->user?->name ?? 'A', 0, 1)) }}
            </div>
            <span class="fw-semibold">{{ $portfolio->user?->name ?? 'Admin' }}</span>
          </div>

          <div id="carousel-{{ $portfolio->id }}" class="carousel slide">
            @if ($portfolio->images->count() > 1)
              <div class="carousel-indicators">
                @foreach ($portfolio->images as $image)
                  <button type="button"
                          data-bs-target="#carousel-{{ $portfolio->id }}"
                          data-bs-slide-to="{{ $loop->index }}"
                          class="{{ $loop->first ? 'active' : '' }}"
                          aria-label="Gambar {{ $loop->iteration }}"></button>
                @endforeach
              </div>
            @endif

            <div class="carousel-inner">
              @foreach ($portfolio->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                  <img src="{{ asset($image->path) }}" class="d-block w-100 portfolio-img"
                       alt="{{ $portfolio->title }}">
                </div>
              @endforeach
            </div>

            @if ($portfolio->images->count() > 1)
              <button class="carousel-control-prev" type="button"
                      data-bs-target="#carousel-{{ $portfolio->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
              </button>
              <button class="carousel-control-next" type="button"
                      data-bs-target="#carousel-{{ $portfolio->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
              </button>
            @endif
          </div>

          <div class="card-body">
            <h2 class="h6 fw-semibold">{{ $portfolio->title }}</h2>
            @if ($portfolio->description)
              <p class="small mb-2">{!! nl2br(e($portfolio->description)) !!}</p>
            @endif
            <small class="text-muted">{{ $portfolio->created_at->format('d M Y') }}</small>

            @auth
              <div class="mt-3 d-flex gap-2">
                <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-pencil"></i> Ubah
                </a>
                <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST"
                      onsubmit="return confirm('Hapus portofolio ini beserta semua gambarnya?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                </form>
              </div>
            @endauth
          </div>

        </div>
      </div>
    @empty
      <p class="text-center">Belum ada portofolio.</p>
    @endforelse
  </div>
@endsection