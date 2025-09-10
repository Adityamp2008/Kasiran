@extends('layouts.app')
@section('title', 'Edit Stok Produk')

@section('content')
<div class="px-2 mt-4">

  <div class="bg-white shadow rounded-lg p-4 max-w-3xl mx-auto">

    <h2 class="text-lg font-bold text-blue-600 mb-4">Penyesuaian Stok</h2>

    <form action="{{ route('Stok.update', $Product->id) }}" method="POST" class="space-y-3">
      @csrf
      @method('PUT')

      {{-- Nama Produk --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" class="w-full border rounded px-2 py-1 bg-gray-100" 
               value="{{ $Product->supplier->nama_product ?? '-' }}" disabled>
      </div>

      {{-- Jenis Penyesuaian & Jumlah --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Jenis Penyesuaian</label>
          <select name="penyesuaian" required 
                  class="w-full border rounded px-2 py-1 text-gray-900">
            <option value="" disabled selected>-- Pilih Penyesuaian --</option>
            <option value="tambah">Tambahkan</option>
            <option value="kurang">Kurangkan</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Jumlah</label>
          <input type="number" name="jumlah" min="1" 
                 class="w-full border rounded px-2 py-1" 
                 value="{{ old('jumlah') }}" required placeholder="Masukkan jumlah">
        </div>
      </div>

      {{-- Lokasi --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan</label>
        <input type="text" name="lokasi" 
               class="w-full border rounded px-2 py-1" 
               value="{{ old('lokasi', $Product->lokasi ?? '-') }}">
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between mt-2">
        <a href="{{ route('Stok.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">
          Kembali
        </a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
          Simpan Perubahan
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
