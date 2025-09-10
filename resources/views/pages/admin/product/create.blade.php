@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="mt-4 px-2">

  <div class="w-full bg-white shadow rounded-lg p-4 space-y-2">

    <h2 class="text-lg font-bold text-blue-600 mb-2 text-center">Form Tambah Produk</h2>

    {{-- Alert Error --}}
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 px-3 py-2 rounded text-sm mb-2">
        <strong>Oops!</strong> Ada kesalahan input:
        <ul class="list-disc list-inside mt-1 mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('Product.store') }}" method="POST" class="space-y-2">
      @csrf

      {{-- Kategori --}}
      <div class="flex flex-col">
        <label for="kategori_id" class="text-sm font-medium text-gray-700">Kategori</label>
        <select name="kategori_id" id="kategori_id" required
                class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
          <option value="">-- Pilih Kategori --</option>
          @foreach($kategori as $kat)
            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
          @endforeach
        </select>
      </div>

      {{-- Supplier --}}
      <div class="flex flex-col">
        <label for="supplier_id" class="text-sm font-medium text-gray-700">Supplier</label>
        <select name="supplier_id" id="supplier_id" required
                class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
          <option value="">-- Pilih Supplier --</option>
          @foreach($supplier as $sup)
            <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>{{ $sup->nama_supplier }}</option>
          @endforeach
        </select>
      </div>

      {{-- Harga Beli & Harga Jual --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="flex flex-col">
          <label for="harga_beli" class="text-sm font-medium text-gray-700">Harga Beli</label>
          <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}" placeholder="Contoh: 3000" required
                 class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
        </div>
        <div class="flex flex-col">
          <label for="harga_jual" class="text-sm font-medium text-gray-700">Harga Jual</label>
          <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" placeholder="Contoh: 5000" required
                 class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
        </div>
      </div>

      {{-- Stok & Minimal Stok --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="flex flex-col">
          <label for="stok" class="text-sm font-medium text-gray-700">Stok Awal</label>
          <input type="number" name="stok" id="stok" value="{{ old('stok') }}" placeholder="Contoh: 100" required
                 class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
        </div>
        <div class="flex flex-col">
          <label for="stok_minimal" class="text-sm font-medium text-gray-700">Minimal Stok</label>
          <input type="number" name="stok_minimal" id="stok_minimal" value="{{ old('stok_minimal') }}" placeholder="Contoh: 10" required
                 class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
        </div>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between mt-2">
        <a href="{{ route('Product.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-300 transition text-sm flex items-center">
          <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition text-sm flex items-center">
          <i class="fa-solid fa-save me-1"></i> Simpan Produk
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
