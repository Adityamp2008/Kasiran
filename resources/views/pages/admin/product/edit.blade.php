@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Produk</h4>

                <form action="{{ route('Product.update', $Product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                            value="{{ old('nama_produk', $Product->nama_produk) }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" 
                                    {{ $kat->id == $Product->kategori_id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga Beli & Harga Jual -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                    value="{{ old('harga_beli', $Product->harga_beli) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                    value="{{ old('harga_jual', $Product->harga_jual) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Stok & Minimal Stok -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok">Stok Awal</label>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    value="{{ old('stok', $Product->stok) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok_minimal">Minimal Stok</label>
                                <input type="number" class="form-control" id="stok_minimal" name="stok_minimal"
                                    value="{{ old('stok_minimal', $Product->stok_minimal) }}" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('Product.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
