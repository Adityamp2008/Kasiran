@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        {{-- Heading & Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="card-title mb-0">Daftar Produk</h4>
          <a href="{{ route('Product.create') }}" class="btn btn-primary btn-icon-text">
            <i class="fa-solid fa-plus me-2"></i> Tambah Produk
          </a>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> 
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        {{-- Table Produk --}}
        <div class="table-responsive">
          <table class="table table-hover table-borderless align-middle">
            <thead class="border-bottom">
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Stok Minimal</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($Product as $product)
                <tr class="border-bottom">
                  <td class="py-3">{{ $loop->iteration }}</td>
                  <td>{{ $product->kategori->nama ?? '-' }}</td>
                  <td>{{ $product->supplier->nama_supplier ?? '-' }}</td>
                  <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                  <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                  <td>{{ $product->stok }}</td>
                  <td>{{ $product->stok_minimal }}</td>
                  <td class="text-center">

                    {{-- Tombol Edit --}}
                    <a href="{{ route('Product.edit', $product->id) }}" 
                       class="btn btn-warning btn-sm btn-icon-text me-1">
                      <i class="fa-solid fa-pen me-1"></i> Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('Product.destroy', $product->id) }}" 
                          method="POST" 
                          class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              class="btn btn-danger btn-sm btn-icon-text text-white"
                              onclick="return confirm('Yakin mau hapus produk ini?')">
                        <i class="fa-solid fa-trash me-1"></i> Hapus
                      </button>
                    </form>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8">
                    <div class="text-center py-5">
                      <i class="fa-solid fa-box-open fa-2x text-muted"></i>
                      <h5 class="mt-3 mb-0">Belum ada produk</h5>
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
