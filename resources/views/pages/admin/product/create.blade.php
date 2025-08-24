@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="row">
  <div class="col-md-10 offset-md-1 grid-margin">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title text-center mb-4">Form Tambah Produk</h4>

        {{-- Alert Error (Validasi) --}}
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i>
            <strong>Oops!</strong> Ada kesalahan input:
            <ul class="mt-2 mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form action="{{ route('Product.store') }}" method="POST">
          @csrf

          {{-- Kategori --}}
          <div class="form-group mb-4">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                  {{ $kat->nama }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Supplier --}}
          <div class="form-group mb-4">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
              <option value="">-- Pilih Supplier --</option>
              @foreach($supplier as $sup)
                <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                  {{ $sup->nama_supplier }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Harga Beli & Harga Jual --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="harga_beli" class="form-label">Harga Beli</label>
              <input type="number" 
                     class="form-control" 
                     id="harga_beli" 
                     name="harga_beli"
                     value="{{ old('harga_beli') }}"
                     placeholder="Contoh: 3000" 
                     required>
            </div>
            <div class="col-md-6">
              <label for="harga_jual" class="form-label">Harga Jual</label>
              <input type="number" 
                     class="form-control" 
                     id="harga_jual" 
                     name="harga_jual"
                     value="{{ old('harga_jual') }}"
                     placeholder="Contoh: 5000" 
                     required>
            </div>
          </div>

          {{-- Stok Awal & Minimal Stok --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="stok" class="form-label">Stok Awal</label>
              <input type="number" 
                     class="form-control" 
                     id="stok" 
                     name="stok"
                     value="{{ old('stok') }}"
                     placeholder="Contoh: 100" 
                     required>
            </div>
            <div class="col-md-6">
              <label for="stok_minimal" class="form-label">Minimal Stok</label>
              <input type="number" 
                     class="form-control" 
                     id="stok_minimal" 
                     name="stok_minimal"
                     value="{{ old('stok_minimal') }}"
                     placeholder="Contoh: 10" 
                     required>
            </div>
          </div>

          {{-- Tombol --}}
          <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('Product.index') }}" class="btn btn-light btn-icon-text">
              <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-save me-2"></i> Simpan Produk
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
