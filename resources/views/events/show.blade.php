@extends('layouts.page-c')
@section('title', $event->name)

@section('content')
  <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card card-glass h-100">
        <div class="card-body">
          <h1 class="h3 fw-semibold">{{ $event->name }}</h1>
          @if ($event->description)
            <p>{!! nl2br(e($event->description)) !!}</p>
          @endif
          @if ($event->location)
            <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
          @endif
          <p class="mb-1">
            <i class="bi bi-calendar-event"></i>
            {{ $event->start_date->format('d M Y') }} – {{ $event->end_date->format('d M Y') }}
          </p>
          <p class="mb-1">
            <i class="bi bi-hourglass-split"></i>
            Batas pendaftaran: {{ $event->registration_deadline->format('d M Y') }}
          </p>
          <p class="mb-2">
            <i class="bi bi-people"></i>
            Terisi {{ $event->seatsTaken() }} / {{ $event->quota }}
            (sisa {{ $event->seatsLeft() }})
          </p>
          <p class="mb-1"><i class="bi bi-diagram-3"></i> Divisi yang dibuka:</p>
          <div class="d-flex flex-wrap gap-2">
            @foreach ($event->divisions as $division)
              <span class="badge bg-primary">{{ $division->name }}</span>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card card-glass h-100">
        <div class="card-body">
          <h2 class="h5 fw-semibold mb-3">Daftar jadi panitia</h2>

          @if (!$event->isRegistrationOpen())
            <div class="alert alert-secondary mb-0">Pendaftaran sudah ditutup.</div>
          @elseif ($event->seatsLeft() < 1)
            <div class="alert alert-danger mb-0">Kuota sudah penuh.</div>
          @elseif (!auth()->check())
            <div class="alert alert-info mb-0">
              Silakan <a href="{{ route('login') }}">login</a> atau
              <a href="{{ route('register') }}">register</a> untuk mendaftar.
            </div>
          @else
            <form action="{{ route('events.register', $event) }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Nama lengkap</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}">
              </div>

              <div class="mb-3">
                <label for="nrp" class="form-label">NRP (10 digit angka)</label>
                <input type="text" id="nrp" name="nrp"
                       class="form-control @error('nrp') is-invalid @enderror"
                       value="{{ old('nrp') }}"
                       inputmode="numeric" maxlength="10" pattern="[0-9]{10}"
                       placeholder="Contoh: 5025251208">
              </div>

              <div class="mb-3">
                <label for="division" class="form-label">Divisi</label>
                <select id="division" name="division"
                        class="form-select @error('division') is-invalid @enderror">
                  <option value="">-- Pilih divisi --</option>
                  @foreach ($event->divisions as $division)
                    <option value="{{ $division->name }}" @selected(old('division') === $division->name)>
                      {{ $division->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="reason" class="form-label">Alasan bergabung</label>
                <textarea id="reason" name="reason" rows="3"
                          class="form-control @error('reason') is-invalid @enderror">{{ old('reason') }}</textarea>
              </div>

              <button type="submit" class="btn btn-primary">Kirim pendaftaran</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="card card-glass mt-4">
    <div class="card-body">
      <h2 class="h5 fw-semibold mb-3">Daftar pendaftar ({{ $registrations->count() }})</h2>

      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>NRP</th>
              <th>Divisi</th>
              <th>Alasan</th>
              <th>Status</th>
              @auth
                <th>Aksi</th>
              @endauth
            </tr>
          </thead>
          <tbody>
            @forelse ($registrations as $registration)
              @php
                $badge = [
                  'menunggu' => 'warning text-dark',
                  'diterima' => 'success',
                  'ditolak' => 'danger',
                ][$registration->status] ?? 'secondary';
              @endphp
              <tr>
                <td>{{ $registration->name }}</td>
                <td>{{ $registration->nrp }}</td>
                <td>{{ $registration->division }}</td>
                <td>{{ $registration->reason }}</td>
                <td><span class="badge bg-{{ $badge }}">{{ ucfirst($registration->status) }}</span></td>
                @auth
                  <td>
                    <div class="d-flex gap-1">
                      <form action="{{ route('registrations.status', $registration) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="btn btn-sm btn-success">Terima</button>
                      </form>
                      <form action="{{ route('registrations.status', $registration) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                      </form>
                    </div>
                  </td>
                @endauth
              </tr>
            @empty
              <tr>
                <td colspan="{{ auth()->check() ? 6 : 5 }}" class="text-center">Belum ada pendaftar.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection