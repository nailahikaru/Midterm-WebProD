@extends('layouts.page-c')
@section('title', 'Tambah Event')

@section('content')
  <h1 class="h2 fw-semibold mb-4">Tambah Event</h1>
  <div class="card card-glass">
    <div class="card-body">
      <form action="{{ route('events.store') }}" method="POST">
        @csrf
        @include('events._form')
      </form>
    </div>
  </div>
@endsection