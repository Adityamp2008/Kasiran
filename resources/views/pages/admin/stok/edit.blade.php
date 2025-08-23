@extends('layouts.app')
@section('title', 'Edit Stok Produk')

@section('content')
<div class="row">
    <div class="col-lg-8 col-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Penyesuaian Stok</h4>

                <form action="{{ route('Stok.update', $Product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" 
                            value="{{ $Product->supplier->nama_product ?? '-' }}" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok Saat Ini</label>
                            <input type="number" class="form-control" value="{{ $Product->stok }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimal Stok</label>
                            <input type="number" class="form-control" value="{{ $Product->stok_minimal }}" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penyesuaian Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                               value="{{ old('stok', $Product->stok) }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Masukkan jumlah stok terbaru.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi Penyimpanan</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                               value="{{ old('lokasi', $Product->lokasi ?? '-') }}">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Stok.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
