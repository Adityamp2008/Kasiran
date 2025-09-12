@extends('layouts.app')
@section('title', 'Tambah Diskon')

@section('content')
<div class="mt-2 max-w-4xl mx-auto px-0">

  <h2 class="text-2xl font-bold text-blue-600 mb-4 flex items-center">
    <i class="fa-solid fa-percent me-2"></i> Tambah Diskon
  </h2>

  <form action="{{ route('Diskon.store') }}" method="POST" class="space-y-4 bg-white p-4 rounded-xl shadow-sm">
    @csrf

    {{-- Nama Diskon --}}
    <div>
      <label for="nama_diskon" class="block text-sm font-medium text-gray-700 mb-1">Nama Diskon</label>
      <input type="text" id="nama_diskon" name="nama_diskon"
             value="{{ old('nama_diskon') }}" required
             placeholder="Contoh: Diskon Ramadhan"
             class="w-full border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm @error('nama_diskon') @enderror">
      @error('nama_diskon')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

      {{-- Tipe Diskon --}}
      <div>
        <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
        <select id="tipe" name="tipe" required
                class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('tipe') @enderror">
          <option value="" disabled selected>-- Pilih Tipe --</option>
          <option value="potongan" {{ old('tipe') == 'potongan' ? 'selected' : '' }}>Potongan</option>
          <option value="persen" {{ old('tipe') == 'persen' ? 'selected' : '' }}>Persen</option>
        </select>
        @error('tipe')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Nilai Diskon --}}
      <div>
        <label for="nilai" class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
        <input type="number" id="nilai" name="nilai"
               value="{{ old('nilai') }}" required
               placeholder="10000 untuk potongan, 10 untuk persen"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm @error('nilai') @enderror">
        <small class="text-gray-500 text-xs">Isi angka sesuai tipe diskon.</small>
        @error('nilai')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Minimal Pembelian --}}
      <div>
        <label for="min_belanja" class="block text-sm font-medium text-gray-700 mb-1">Minimal Pembelian (Rp)</label>
        <input type="number" id="min_belanja" name="min_belanja"
               value="{{ old('min_belanja') }}"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm @error('min_belanja') @enderror">
        @error('min_belanja')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Minimal Qty --}}
      <div>
        <label for="min_qty" class="block text-sm font-medium text-gray-700 mb-1">Minimal Jumlah Barang</label>
        <input type="number" id="min_qty" name="min_qty"
               value="{{ old('min_qty') }}"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm @error('min_qty') @enderror">
        @error('min_qty')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

    </div>

    {{-- Status Aktif/Nonaktif --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
      <div class="flex gap-3">
        <label class="inline-flex items-center cursor-pointer">
          <input type="radio" class="form-radio" name="status" value="1" {{ old('status',1)==1?'checked':'' }}>
          <span class="ml-2 text-sm">Aktif</span>
        </label>
        <label class="inline-flex items-center cursor-pointer">
          <input type="radio" class="form-radio" name="status" value="0" {{ old('status',1)==0?'checked':'' }}>
          <span class="ml-2 text-sm">Nonaktif</span>
        </label>
      </div>
      @error('status')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end gap-3 pt-2">
      <a href="{{ route('Diskon.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg hover:bg-gray-300 transition text-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
      </a>
      <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition text-sm">
        <i class="fa-solid fa-save me-1"></i> Simpan
      </button>
    </div>

  </form>

</div>
@endsection
