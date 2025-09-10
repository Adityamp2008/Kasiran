@extends('layouts.app')
@section('title', 'Edit Diskon')

@section('content')
<div class="row">
    <div class="col-lg-8 col-12 mx-auto">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Diskon</h4>

                <form action="{{ route('Diskon.update', $diskon->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Diskon</label>
                        <input type="text" name="nama_diskon"
                            class="form-control @error('nama_diskon') is-invalid @enderror"
                            value="{{ old('nama_diskon', $diskon->nama_diskon) }}" required>
                        @error('nama_diskon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Diskon</label>
                            <select name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
                                <option value="potongan" {{ old('tipe', $diskon->tipe) == 'potongan' ? 'selected' : '' }}>Potongan</option>
                                <option value="persen" {{ old('tipe', $diskon->tipe) == 'persen' ? 'selected' : '' }}>Persen</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nilai Diskon</label>
                            <input type="number" name="nilai"
                                class="form-control @error('nilai') is-invalid @enderror"
                                value="{{ old('nilai', $diskon->nilai) }}" required>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Isi dengan angka (contoh: 10000 untuk potongan atau 10 untuk persen).</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimal Pembelian (Rp)</label>
                            <input type="number" name="min_belanja"
                                class="form-control @error('min_belanja') is-invalid @enderror"
                                value="{{ old('min_belanja', $diskon->min_belanja) }}">
                            @error('min_belanja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimal Jumlah Barang</label>
                            <input type="number" name="min_qty"
                                class="form-control @error('min_qty') is-invalid @enderror"
                                value="{{ old('min_qty', $diskon->min_qty) }}">
                            @error('min_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $diskon->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $diskon->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Diskon.index') }}" class="btn btn-secondary">
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
