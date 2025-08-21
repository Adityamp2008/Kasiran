@extends('layouts.app')
@section('title', 'Edit Supplier')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Supplier</h4>

                <form action="{{ route('Supplier.update', $Supplier->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" id="nama_supplier" name="nama_supplier" 
                               value="{{ old('nama_supplier', $Supplier->nama_supplier) }}" 
                               class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kontak">Kontak</label>
                        <input type="text" id="kontak" name="kontak" 
                               value="{{ old('kontak', $Supplier->kontak) }}" 
                               class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control">{{ old('alamat', $Supplier->alamat) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('Supplier.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
