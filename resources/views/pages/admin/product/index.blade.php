@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="mt-4 px-2">

  <div class="w-full bg-white shadow rounded-lg p-4 space-y-2">

    {{-- Heading & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-3">
      <h4 class="text-lg font-bold text-blue-600">Daftar Produk</h4>
      <a href="{{ route('Product.create') }}" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition text-sm flex items-center">
        <i class="fa-solid fa-plus me-1"></i> Tambah Produk
      </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
      <div class="bg-green-100 text-green-800 px-3 py-2 rounded text-sm flex justify-between items-center">
        <span><i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" class="text-green-800">&times;</button>
      </div>
    @endif

    {{-- Table Produk --}}
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left border-collapse">
        <thead class="border-b">
          <tr>
            <th class="px-3 py-2">No</th>
            <th class="px-3 py-2">Kategori</th>
            <th class="px-3 py-2">Supplier</th>
            <th class="px-3 py-2">Harga Beli</th>
            <th class="px-3 py-2">Harga Jual</th>
            <th class="px-3 py-2">Stok</th>
            <th class="px-3 py-2">Stok Minimal</th>
            <th class="px-3 py-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($Product as $product)
            <tr class="border-b hover:bg-gray-50">
              <td class="px-3 py-2">{{ $loop->iteration }}</td>
              <td class="px-3 py-2">{{ $product->kategori->nama ?? '-' }}</td>
              <td class="px-3 py-2">{{ $product->supplier->nama_supplier ?? '-' }}</td>
              <td class="px-3 py-2">Rp {{ number_format($product->harga_beli,0,',','.') }}</td>
              <td class="px-3 py-2">Rp {{ number_format($product->harga_jual,0,',','.') }}</td>
              <td class="px-3 py-2">{{ $product->stok }}</td>
              <td class="px-3 py-2">{{ $product->stok_minimal }}</td>
              <td class="px-3 py-2 text-center space-x-1">
                <a href="{{ route('Product.edit', $product->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 text-xs">Edit</a>
                <form action="{{ route('Product.destroy', $product->id) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin mau hapus produk ini?')" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">
                <div class="text-center py-5 text-gray-500">
                  <i class="fa-solid fa-box-open fa-2x"></i>
                  <h5 class="mt-2">Belum ada produk</h5>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
