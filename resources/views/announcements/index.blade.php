@extends('layouts.page-c')
@section('title', 'Pengumuman')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-semibold mb-0">Pengumuman</h1>
    @auth
      <a href="{{ route('announcements.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah
      </a>
    @endauth
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @forelse ($announcements as $announcement)
    <div class="card card-glass mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <h2 class="h5 fw-semibold">{{ $announcement->title }}</h2>
          <small class="text-muted">{{ $announcement->created_at->format('d M Y, H:i') }}</small>
        </div>
        <p class="mb-2">{!! nl2br(e($announcement->content)) !!}</p>
        <small class="text-muted">Oleh {{ $announcement->user?->name ?? 'Admin' }}</small>

        @auth
          <div class="mt-3 d-flex gap-2">
            <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-outline-primary">
              <i class="bi bi-pencil"></i> Ubah
            </a>
            <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
                  onsubmit="return confirm('Hapus pengumuman ini?')">
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
  @empty
    <p class="text-center">Belum ada pengumuman.</p>
  @endforelse
@endsection