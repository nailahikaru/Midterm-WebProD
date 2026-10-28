<div class="mb-3">
  <label for="title" class="form-label">Judul</label>
  <input type="text" id="title" name="title"
         class="form-control @error('title') is-invalid @enderror"
         value="{{ old('title', $announcement->title ?? '') }}">
  @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="content" class="form-label">Isi pengumuman</label>
  <textarea id="content" name="content" rows="6"
            class="form-control @error('content') is-invalid @enderror">{{ old('content', $announcement->content ?? '') }}</textarea>
  @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="d-flex gap-2">
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="{{ route('announcements.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>