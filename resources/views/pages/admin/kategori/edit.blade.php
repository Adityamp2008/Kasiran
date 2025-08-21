@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Kategori</h4>
                <form action="{{ route('Kategori.update', $kategori->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" id="namaKategori" name="nama"
                               value="{{ old('nama', $kategori->nama) }}"
                               class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-icon-text">
                        Update 
                    </button>
                    <a href="{{ route('Kategori.index') }}" class="btn btn-light">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
