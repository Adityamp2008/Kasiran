@extends('layouts.app')
@section('title', 'Manajemen Kategori')

@section('content')
<div class="row">

  {{-- Form Tambah Kategori --}}
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-4">Tambah Kategori Baru</h4>

        <form action="{{ route('Kategori.store') }}" method="POST" class="mt-3">
          @csrf
          <div class="form-group">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <div class="input-group">
              <input 
                type="text" 
                id="namaKategori" 
                name="nama" 
                class="form-control" 
                placeholder="Contoh: Minuman Dingin" 
                required
              >
              <button type="submit" class="btn btn-primary btn-icon-text">
                <i class="fa-solid fa-save me-2"></i> Simpan
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

  {{-- Tabel Daftar Kategori --}}
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-4">Daftar Kategori</h4>

        <div class="table-responsive">
          <table class="table table-hover table-borderless align-middle">
            <thead>
              <tr class="border-bottom">
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($kategori as $item)
                <tr class="border-bottom">
                  <td class="py-3">{{ $loop->iteration }}</td>
                  <td class="py-3">{{ $item->nama }}</td>
                  <td class="py-3 text-muted">{{ $item->slug }}</td>
                  <td class="py-3 text-center">

                    {{-- Tombol Edit --}}
                    <a href="{{ route('Kategori.edit', $item->id) }}" 
                       class="btn btn-warning btn-sm btn-icon-text me-1" 
                       title="Edit">
                      <i class="fa-solid fa-pen me-1"></i> Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('Kategori.destroy', $item->id) }}" 
                          method="POST" 
                          class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              class="btn btn-danger btn-sm btn-icon-text text-white" 
                              onclick="return confirm('Anda yakin ingin menghapus kategori ini?')" 
                              title="Hapus">
                        <i class="fa-solid fa-trash me-1"></i> Hapus
                      </button>
                    </form>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">
                    <div class="text-center py-5">
                      <i class="fa-solid fa-box-open fa-2x text-muted"></i>
                      <h5 class="mt-3 mb-0">Data Kategori Kosong</h5>
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
