@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2>Daftar Pendaftaran</h2>
  <p>Total: {{ count($registrations) }}</p>
  <a href="/" class="btn btn-sm btn-primary" role="button">Tambah</a>
  @if(session()->has('message'))
  @if(session('type') == 'create')
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <h4 class="alert-heading">Berhasil!</h4>
    <p>{{ session('message') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @else
  <div class="alert alert-{{ session('type') }} alert-dismissible fade show mt-3" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @endif
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show mt-3">
    <p>Update gagal</p>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <table class="table border table-striped table-hover mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Alamat</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($registrations as $registration)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $registration->nama }}</td>
        <td>{{ $registration->email }}</td>
        <td>{{ $registration->alamat }}</td>
        <td>
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#{{'editModal'.$registration->id}}">Edit</button>
          <div class="modal fade" id="{{'editModal'.$registration->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('update', $registration->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $registration->nama }}" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $registration->email }}" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" class="form-control" required>{{ $registration->alamat }}</textarea>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{'deleteModal'.$registration->id}}">Hapus</button>
          <div class="modal fade" id="{{'deleteModal'.$registration->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <h5>Apakah anda yakin ingin menghapus data pendaftaran ini?</h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                  <form action="{{ route('destroy', $registration->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Ya</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection