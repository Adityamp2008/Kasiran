@extends('layouts.app')
@section('title', 'Edit Supplier')

@section('content')
<div class="mt-4 px-2">

  <div class="w-full bg-white shadow rounded-lg p-4 space-y-2">

    <h2 class="text-lg font-bold text-blue-600 mb-2">Edit Supplier</h2>

    <form action="{{ route('Supplier.update', $Supplier->id) }}" method="POST" class="space-y-2">
      @csrf
      @method('PUT')

      {{-- Nama Supplier --}}
      <div class="flex flex-col">
        <label for="nama_supplier" class="text-sm font-medium text-gray-700">Nama Supplier</label>
        <input type="text" id="nama_supplier" name="nama_supplier"
               value="{{ old('nama_supplier', $Supplier->nama_supplier) }}"
               required
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
      </div>

      {{-- Nama Product --}}
      <div class="flex flex-col">
        <label for="nama_product" class="text-sm font-medium text-gray-700">Nama Product</label>
        <input type="text" id="nama_product" name="nama_product"
               value="{{ old('nama_product', $Supplier->nama_product) }}"
               required
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
      </div>

      {{-- Kontak --}}
      <div class="flex flex-col">
        <label for="kontak" class="text-sm font-medium text-gray-700">Kontak</label>
        <input type="text" id="kontak" name="kontak"
               value="{{ old('kontak', $Supplier->kontak) }}"
               class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">
      </div>

      {{-- Alamat --}}
      <div class="flex flex-col">
        <label for="alamat" class="text-sm font-medium text-gray-700">Alamat</label>
        <textarea id="alamat" name="alamat" rows="2"
                  class="border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-400 text-sm">{{ old('alamat', $Supplier->alamat) }}</textarea>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between">
        <a href="{{ route('Supplier.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-300 transition text-sm">
          Batal
        </a>
        <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition text-sm">
          Simpan Perubahan
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
