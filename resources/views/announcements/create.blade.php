@extends('layouts.page-c')
@section('title', 'Tambah Pengumuman')

@section('content')
  <h1 class="h2 fw-semibold mb-4">Tambah Pengumuman</h1>
  <div class="card card-glass">
    <div class="card-body">
      <form action="{{ route('announcements.store') }}" method="POST">
        @csrf
        @include('announcements._form')
      </form>
    </div>
  </div>
@endsection