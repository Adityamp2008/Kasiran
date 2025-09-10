@extends('layouts.app')
@section('title', 'Kelola Stok Produk')

@section('content')
<div class="px-2 mt-4">

  <div class="bg-white shadow rounded-lg p-3">

    <h2 class="text-lg font-bold text-blue-600 mb-3">Daftar Stok Produk</h2>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-2 rounded text-sm mb-2">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto">
      <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100 text-gray-700 text-sm">
          <tr>
            <th class="px-2 py-1 border">No</th>
            <th class="px-2 py-1 border">Nama Produk</th>
            <th class="px-2 py-1 border">Kategori</th>
            <th class="px-2 py-1 border">Harga Jual</th>
            <th class="px-2 py-1 border">Stok Saat Ini</th>
            <th class="px-2 py-1 border">Minimal Stok</th>
            <th class="px-2 py-1 border">Status</th>
            <th class="px-2 py-1 border">Lokasi</th>
            <th class="px-2 py-1 border">Update</th>
            <th class="px-2 py-1 border">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-sm text-gray-800">
          @forelse($Product as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-2 py-1 border">{{ $loop->iteration }}</td>
              <td class="px-2 py-1 border">{{ $item->supplier->nama_product ?? '-' }}</td>
              <td class="px-2 py-1 border">{{ $item->kategori->nama ?? '-' }}</td>
              <td class="px-2 py-1 border">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
              <td class="px-2 py-1 border">{{ $item->stok }}</td>
              <td class="px-2 py-1 border">{{ $item->stok_minimal }}</td>
              <td class="px-2 py-1 border">
                <span class="px-2 py-0.5 rounded text-white text-xs {{ $item->stok <= $item->stok_minimal ? 'bg-red-500' : 'bg-green-500' }}">
                  {{ $item->stok <= $item->stok_minimal ? 'Habis' : 'Aman' }}
                </span>
              </td>
              <td class="px-2 py-1 border">{{ $item->lokasi ?? '-' }}</td>
              <td class="px-2 py-1 border">{{ $item->updated_at->format('d-m-Y') }}</td>
              <td class="px-2 py-1 border text-center">
                <a href="{{ route('Stok.edit', $item->id) }}" 
                   class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 text-xs inline-flex items-center">
                  <i class="fa-solid fa-pen me-1"></i> Penyesuaian
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center py-6 text-gray-400">
                <i class="fa-solid fa-box-open text-2xl"></i>
                <p class="mt-2">Belum ada produk</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
