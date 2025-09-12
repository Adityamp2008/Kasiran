@extends('layouts.app')
@section('title', 'Edit Diskon')

@section('content')
<div class="mt-6 max-w-4xl mx-auto px-4">

  <h2 class="text-2xl font-bold text-blue-600 mb-4 flex items-center">
    <i class="fa-solid fa-percent me-2"></i> Edit Diskon
  </h2>

  <form action="{{ route('Diskon.update', $diskon->id) }}" method="POST" class="space-y-4 bg-white p-4 rounded-xl shadow-sm">
    @csrf
    @method('PUT')

    {{-- Nama Diskon --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Nama Diskon</label>
      <input type="text" name="nama_diskon" required
             value="{{ old('nama_diskon', $diskon->nama_diskon) }}"
             class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama_diskon') border-red-500 @enderror">
      @error('nama_diskon')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      {{-- Tipe Diskon --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
        <select name="tipe" required
                class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('tipe') border-red-500 @enderror">
          <option value="potongan" {{ old('tipe', $diskon->tipe)=='potongan'?'selected':'' }}>Potongan</option>
          <option value="persen" {{ old('tipe', $diskon->tipe)=='persen'?'selected':'' }}>Persen</option>
        </select>
        @error('tipe')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Nilai Diskon --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
        <input type="number" name="nilai" required
               value="{{ old('nilai', $diskon->nilai) }}"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nilai') border-red-500 @enderror">
        <small class="text-gray-500 text-xs">Contoh: 10000 untuk potongan atau 10 untuk persen</small>
        @error('nilai')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Minimal Pembelian --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Minimal Pembelian (Rp)</label>
        <input type="number" name="min_belanja"
               value="{{ old('min_belanja', $diskon->min_belanja) }}"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('min_belanja') border-red-500 @enderror">
        @error('min_belanja')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      {{-- Minimal Qty --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Minimal Jumlah Barang</label>
        <input type="number" name="min_qty"
               value="{{ old('min_qty', $diskon->min_qty) }}"
               class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('min_qty') border-red-500 @enderror">
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
          <input type="radio" name="status" value="1" {{ old('status', $diskon->status)==1?'checked':'' }}>
          <span class="ml-2 text-sm">Aktif</span>
        </label>
        <label class="inline-flex items-center cursor-pointer">
          <input type="radio" name="status" value="0" {{ old('status', $diskon->status)==0?'checked':'' }}>
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
        <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
      </button>
    </div>

  </form>
</div>
@endsection
