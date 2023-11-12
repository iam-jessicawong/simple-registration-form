@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col">
      <h1>Form Registrasi</h1>
    </div>
  </div>
  <form action="{{ route('store') }}" method="post">
    @csrf
    <div class="row mb-3">
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
        @error('nama')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="row mb-3">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="row mb-3">
      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-10">
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
        @error('alamat')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Registrasi</button>
  </form>
</div>
@endsection