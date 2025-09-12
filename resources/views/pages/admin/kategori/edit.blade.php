@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="flex justify-center mt-6">

  <div class="w-full max-w-md bg-white shadow-md rounded-xl p-5">
    <h2 class="text-lg font-bold text-blue-600 mb-4 flex items-center">
      <i class="fa-solid fa-pen-to-square mr-2 text-blue-500"></i> Edit Kategori
    </h2>

    <form action="{{ route('Kategori.update', $kategori->id) }}" method="POST" class="space-y-3">
      @csrf
      @method('PUT')

      {{-- Input Nama --}}
      <div class="flex flex-col">
        <label for="namaKategori" class="text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
        <input 
          type="text" 
          id="namaKategori" 
          name="nama"
          value="{{ old('nama', $kategori->nama) }}"
          placeholder="Contoh: Minuman Dingin" 
          required
          class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
      </div>

      {{-- Tombol --}}
      <div class="flex gap-2">
        <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 hover:shadow transition-all flex justify-center items-center text-sm">
          <i class="fa-solid fa-rotate mr-2"></i> Update
        </button>
        <a href="{{ route('Kategori.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 hover:shadow transition-all flex justify-center items-center text-sm">
          <i class="fa-solid fa-xmark mr-2"></i> Batal
        </a>
      </div>

    </form>
  </div>

</div>
@endsection
