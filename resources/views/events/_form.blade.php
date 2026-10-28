@php
  $event = $event ?? null;
  $divisionText = old(
    'divisions',
    $event
      ? $event->divisions->pluck('name')->implode("\n")
      : "Acara\nHumas\nDokumentasi\nPerlengkapan\nKonsumsi\nDesain"
  );
@endphp

<div class="mb-3">
  <label for="name" class="form-label">Nama event</label>
  <input type="text" id="name" name="name"
         class="form-control @error('name') is-invalid @enderror"
         value="{{ old('name', $event?->name) }}">
  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="description" class="form-label">Deskripsi (opsional)</label>
  <textarea id="description" name="description" rows="4"
            class="form-control @error('description') is-invalid @enderror">{{ old('description', $event?->description) }}</textarea>
  @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="location" class="form-label">Lokasi (opsional)</label>
  <input type="text" id="location" name="location"
         class="form-control @error('location') is-invalid @enderror"
         value="{{ old('location', $event?->location) }}">
  @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-4 mb-3">
    <label for="start_date" class="form-label">Tanggal mulai</label>
    <input type="date" id="start_date" name="start_date"
           class="form-control @error('start_date') is-invalid @enderror"
           value="{{ old('start_date', $event?->start_date?->format('Y-m-d')) }}">
    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-4 mb-3">
    <label for="end_date" class="form-label">Tanggal selesai</label>
    <input type="date" id="end_date" name="end_date"
           class="form-control @error('end_date') is-invalid @enderror"
           value="{{ old('end_date', $event?->end_date?->format('Y-m-d')) }}">
    @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-4 mb-3">
    <label for="registration_deadline" class="form-label">Batas pendaftaran</label>
    <input type="date" id="registration_deadline" name="registration_deadline"
           class="form-control @error('registration_deadline') is-invalid @enderror"
           value="{{ old('registration_deadline', $event?->registration_deadline?->format('Y-m-d')) }}">
    @error('registration_deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mb-3">
  <label for="quota" class="form-label">Kuota panitia</label>
  <input type="number" id="quota" name="quota" min="1"
         class="form-control @error('quota') is-invalid @enderror"
         value="{{ old('quota', $event?->quota) }}">
  @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="divisions" class="form-label">Divisi yang dibuka</label>
  <textarea id="divisions" name="divisions" rows="6"
            class="form-control @error('divisions') is-invalid @enderror">{{ $divisionText }}</textarea>
  <div class="form-text">Tulis satu divisi per baris. Hanya divisi ini yang muncul di formulir pendaftaran event.</div>
  @error('divisions') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="d-flex gap-2">
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>