@extends('layouts.page-c')
@section('title', 'Event Kepanitiaan')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-semibold mb-0">Event Kepanitiaan</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Tambah Event
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row g-4">
    @forelse ($events as $event)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card card-glass h-100">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
              <h2 class="h5 fw-semibold mb-0">{{ $event->name }}</h2>
              @if (!$event->isRegistrationOpen())
                <span class="badge bg-secondary">Ditutup</span>
              @elseif ($event->seatsLeft() < 1)
                <span class="badge bg-danger">Penuh</span>
              @else
                <span class="badge bg-success">Dibuka</span>
              @endif
            </div>

            @if ($event->location)
              <p class="small mb-1"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
            @endif
            <p class="small mb-1">
              <i class="bi bi-calendar-event"></i>
              {{ $event->start_date->format('d M Y') }} – {{ $event->end_date->format('d M Y') }}
            </p>
            <p class="small mb-1">
              <i class="bi bi-hourglass-split"></i>
              Batas daftar: {{ $event->registration_deadline->format('d M Y') }}
            </p>
            <p class="small mb-3">
              <i class="bi bi-people"></i>
              Terisi {{ $event->seatsTaken() }} / {{ $event->quota }}
            </p>

            <div class="mt-auto d-flex flex-wrap gap-2">
              <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary">
                Detail dan Daftar
              </a>
              <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i> Ubah
              </a>
              <form action="{{ route('events.destroy', $event) }}" method="POST"
                    onsubmit="return confirm('Hapus event ini beserta semua pendaftarnya?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">Belum ada event.</p>
    @endforelse
  </div>
@endsection