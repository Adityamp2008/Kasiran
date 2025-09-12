@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

  {{-- Form Tambah Kategori --}}
  <div class="lg:w-1/3 bg-white shadow-md rounded-xl p-4">
    <h2 class="text-lg font-bold text-blue-600 mb-3 flex items-center">
      <i class="fa-solid fa-plus-circle mr-2 text-blue-500"></i> Tambah Kategori
    </h2>

    <form action="{{ route('Kategori.store') }}" method="POST" class="space-y-3">
      @csrf
      <input 
        type="text" 
        name="nama" 
        placeholder="Contoh: Minuman Dingin" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      >
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 hover:shadow transition-all flex justify-center items-center text-sm">
        <i class="fa-solid fa-save mr-2"></i> Simpan
      </button>
    </form>
  </div>

  {{-- Tabel Daftar Kategori --}}
  <div class="lg:w-2/3 bg-white shadow-md rounded-xl p-4 overflow-x-auto">
    <h2 class="text-lg font-bold text-blue-600 mb-3 flex items-center">
      <i class="fa-solid fa-list-ul mr-2 text-blue-500"></i> Daftar Kategori
    </h2>

    <table class="min-w-full border border-gray-100 rounded-xl overflow-hidden text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left font-medium text-gray-600">No</th>
          <th class="px-4 py-2 text-left font-medium text-gray-600">Nama Kategori</th>
          <th class="px-4 py-2 text-left font-medium text-gray-600">Slug</th>
          <th class="px-4 py-2 text-center font-medium text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($kategori as $item)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 font-medium">{{ $item->nama }}</td>
            <td class="px-4 py-2 text-gray-400">{{ $item->slug }}</td>
            <td class="px-4 py-2 text-center space-x-1">
              <a href="{{ route('Kategori.edit', $item->id) }}" 
                 class="inline-flex items-center bg-yellow-400 text-white px-2 py-1 rounded-md hover:bg-yellow-500 hover:shadow transition-all text-xs">
                <i class="fa-solid fa-pen mr-1"></i> Edit
              </a>
              <form action="{{ route('Kategori.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Anda yakin ingin menghapus kategori ini?')" 
                        class="inline-flex items-center bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-700 hover:shadow transition-all text-xs">
                  <i class="fa-solid fa-trash mr-1"></i> Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="py-8 text-center text-gray-400">
              <i class="fa-solid fa-box-open fa-lg mb-1 block"></i>
              <span class="text-sm">Belum ada data kategori</span>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
