@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1 grid-margin">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Form Tambah Produk</h4>

                <form action="{{ route('Product.store') }}" method="POST">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="form-group mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                               placeholder="Contoh: Teh Botol Sosro" required>
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group mb-4">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga Beli & Harga Jual (sampingan) --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                   placeholder="Contoh: 3000" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                   placeholder="Contoh: 5000" required>
                        </div>
                    </div>

                    {{-- Stok Awal & Minimal Stok (sampingan) --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="stok" class="form-label">Stok Awal</label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                   placeholder="Contoh: 100" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stok_minimal" class="form-label">Minimal Stok</label>
                            <input type="number" class="form-control" id="stok_minimal" name="stok_minimal"
                                   placeholder="Contoh: 10" required>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('Product.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Simpan Produk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
