@extends('layouts.app')
@section('title', 'Manajemen Kategori')

@section('content')


<div class="row">
    <!-- Form Tambah Kategori -->
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Kategori Baru</h4>
                    <form action="{{ route('Kategori.store') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <div class="input-group">
                                <input type="text" id="namaKategori" name="nama" class="form-control" placeholder="Contoh: Minuman Dingin" required>
                                <button type="submit" class="btn btn-primary btn-icon-text">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Kategori</h4>
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr class="border-bottom">
                                <th class="font-weight-bold">No</th>
                                <th class="font-weight-bold">Nama Kategori</th>
                                <th class="font-weight-bold">Slug</th>
                                <th class="font-weight-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategori as $item)
                                <tr class="border-bottom">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3">{{ $item->nama }}</td>
                                    <td class="py-3"><span class="font-weight-light">{{ $item->slug }}</span></td>
                                    <td class="py-3 text-center">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('Kategori.edit', $item->id) }}" type="button" class="btn btn-warning btn-icon-text" title="Edit">
                                                <i class="mdi mdi-pencil-outline btn-icon-prepend"></i>
                                                Edit
                                            </a>           
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('Kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-tex text-white" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')" title="Hapus">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center py-5">
                                            <i class="mdi mdi-inbox-arrow-down-outline mdi-48px text-muted"></i>
                                            <h5 class="mt-3">Data Kategori Kosong</h5>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection