@extends('layouts.app')
@section('title', 'Tambah Supplier')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Supplier Baru</h4>

                <form action="{{ route('Supplier.store') }}" method="POST" class="mt-3">
                    @csrf

                    <!-- Nama Supplier -->
                    <div class="form-group mb-3">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" id="nama_supplier" name="nama_supplier" 
                               class="form-control @error('nama_supplier') is-invalid @enderror" 
                               placeholder="Contoh: PT Aqua Indonesia" value="{{ old('nama_supplier') }}" required>
                        @error('nama_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_Product">Nama Product</label>
                        <input type="text" id="nama_product" name="nama_product" 
                               class="form-control @error('nama_product') is-invalid @enderror" 
                               placeholder="Contoh : Aqua Mineral" value="{{ old('nama_product') }}" required>
                        @error('nama_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="form-group mb-3">
                        <label for="kontak">Kontak</label>
                        <input type="text" id="kontak" name="kontak" 
                               class="form-control @error('kontak') is-invalid @enderror" 
                               placeholder="+62-123456" value="{{ old('kontak') }}">
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" 
                               class="form-control @error('alamat') is-invalid @enderror" 
                               placeholder="Contoh: Jakarta" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Supplier.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
