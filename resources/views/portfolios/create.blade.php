@extends('layouts.page-c')
@section('title', 'Tambah Portofolio')

@section('content')
  <h1 class="h2 fw-semibold mb-4">Tambah Portofolio</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card card-glass">
    <div class="card-body">
      <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="title" class="form-label">Judul karya</label>
          <input type="text" id="title" name="title" class="form-control"
                 value="{{ old('title') }}">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi (opsional)</label>
          <textarea id="description" name="description" rows="4"
                    class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <label for="images" class="form-label">Gambar</label>
          <input type="file" id="images" name="images[]" class="form-control"
                 accept="image/*" multiple>
          <div class="form-text">Pilih 1 sampai 5 gambar (JPG, PNG, atau WEBP), maksimal 10 MB per gambar.</div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('portfolios.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection