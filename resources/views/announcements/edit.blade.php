@extends('layouts.page-c')
@section('title', 'Ubah Pengumuman')

@section('content')
  <h1 class="h2 fw-semibold mb-4">Ubah Pengumuman</h1>
  <div class="card card-glass">
    <div class="card-body">
      <form action="{{ route('announcements.update', $announcement) }}" method="POST">
        @csrf
        @method('PUT')
        @include('announcements._form')
      </form>
    </div>
  </div>
@endsection