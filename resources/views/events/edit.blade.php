@extends('layouts.page-c')
@section('title', 'Ubah Event')

@section('content')
  <h1 class="h2 fw-semibold mb-4">Ubah Event</h1>
  <div class="card card-glass">
    <div class="card-body">
      <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')
        @include('events._form')
      </form>
    </div>
  </div>
@endsection