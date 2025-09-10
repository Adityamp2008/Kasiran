@extends('layouts.app')
@section('title', 'Tambah Diskon')

@section('content')
<div class="row">
    <div class="col-lg-8 col-12 mx-auto">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah Diskon</h4>

                <form action="{{ route('Diskon.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Diskon</label>
                        <input type="text" name="nama_diskon"
                            class="form-control @error('nama_diskon') is-invalid @enderror"
                            value="{{ old('nama_diskon') }}" required>
                        @error('nama_diskon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Diskon</label>
                            <select name="tipe" class="text-dark fw-semibold form-select @error('tipe') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Tipe --</option>
                                <option value="potongan" {{ old('tipe') == 'potongan' ? 'selected' : '' }}>Potongan</option>
                                <option value="persen" {{ old('tipe') == 'persen' ? 'selected' : '' }}>Persen</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nilai Diskon</label>
                            <input type="number" name="nilai"
                                class="form-control @error('nilai') is-invalid @enderror"
                                value="{{ old('nilai') }}" required>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Isi angka (contoh: 10000 untuk potongan, 10 untuk persen).</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimal Pembelian (Rp)</label>
                            <input type="number" name="min_belanja"
                                class="form-control @error('min_belanja') is-invalid @enderror"
                                value="{{ old('min_belanja') }}">
                            @error('min_belanja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimal Jumlah Barang</label>
                            <input type="number" name="min_qty"
                                class="form-control @error('min_qty') is-invalid @enderror"
                                value="{{ old('min_qty') }}">
                            @error('min_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="text-dark fw-semibold form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Diskon.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-plus"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
