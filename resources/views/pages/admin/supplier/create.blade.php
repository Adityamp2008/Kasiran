@extends('layouts.app')
@section('title', 'Tambah Supplier')

@section('content')
<div class="mt-4 px-2">

  <div class="w-full bg-white shadow rounded-lg p-4 space-y-2">

    <h2 class="text-lg font-bold text-blue-600 mb-2">Tambah Supplier Baru</h2>

    <form action="{{ route('Supplier.store') }}" method="POST" class="space-y-2">
      @csrf

      {{-- Nama Supplier --}}
      <div class="flex flex-col">
        <label for="nama_supplier" class="text-sm font-medium text-gray-700">Nama Supplier</label>
        <input type="text" id="nama_supplier" name="nama_supplier"
               value="{{ old('nama_supplier') }}"
               placeholder="PT Aqua Indonesia"
               required
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm @error('nama_supplier') border-red-500 @enderror">
        @error('nama_supplier')
          <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Nama Product --}}
      <div class="flex flex-col">
        <label for="nama_product" class="text-sm font-medium text-gray-700">Nama Product</label>
        <input type="text" id="nama_product" name="nama_product"
               value="{{ old('nama_product') }}"
               placeholder="Aqua Mineral"
               required
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm @error('nama_product') border-red-500 @enderror">
        @error('nama_product')
          <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Kontak --}}
      <div class="flex flex-col">
        <label for="kontak" class="text-sm font-medium text-gray-700">Kontak</label>
        <input type="text" id="kontak" name="kontak"
               value="{{ old('kontak') }}"
               placeholder="+62-123456"
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm @error('kontak') border-red-500 @enderror">
        @error('kontak')
          <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Alamat --}}
      <div class="flex flex-col">
        <label for="alamat" class="text-sm font-medium text-gray-700">Alamat</label>
        <input type="text" id="alamat" name="alamat"
               value="{{ old('alamat') }}"
               placeholder="Jakarta"
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm @error('alamat') border-red-500 @enderror">
        @error('alamat')
          <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between">
        <a href="{{ route('Supplier.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-300 transition text-sm">
          Kembali
        </a>
        <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition text-sm">
          Simpan
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
