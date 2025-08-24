@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-4">Edit Kategori</h4>

        <form action="{{ route('Kategori.update', $kategori->id) }}" method="POST" class="mt-3">
          @csrf
          @method('PUT')

          <div class="form-group mb-3">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <input 
              type="text" 
              id="namaKategori" 
              name="nama"
              value="{{ old('nama', $kategori->nama) }}"
              class="form-control" 
              placeholder="Contoh: Minuman Dingin" 
              required
            >
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-rotate me-2"></i> Update
            </button>
            <a href="{{ route('Kategori.index') }}" class="btn btn-light btn-icon-text">
              <i class="fa-solid fa-xmark me-2"></i> Batal
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
