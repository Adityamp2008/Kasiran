@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

  {{-- Form Tambah Kategori --}}
  <div class="lg:w-1/3 bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Tambah Kategori Baru</h2>

    <form action="{{ route('Kategori.store') }}" method="POST" class="space-y-3">
      @csrf
      <input 
        type="text" 
        name="nama" 
        placeholder="Contoh: Minuman Dingin" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      >
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition flex justify-center items-center">
        <i class="fa-solid fa-save me-2"></i> Simpan
      </button>
    </form>
  </div>

  {{-- Tabel Daftar Kategori --}}
  <div class="lg:w-2/3 bg-white shadow rounded-lg p-6 overflow-x-auto">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Daftar Kategori</h2>

    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama Kategori</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Slug</th>
          <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($kategori as $item)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $item->nama }}</td>
            <td class="px-4 py-2 text-gray-400">{{ $item->slug }}</td>
            <td class="px-4 py-2 text-center space-x-1">
              <a href="{{ route('Kategori.edit', $item->id) }}" 
                 class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition text-sm">
                <i class="fa-solid fa-pen me-1"></i> Edit
              </a>
              <form action="{{ route('Kategori.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Anda yakin ingin menghapus kategori ini?')" 
                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 transition text-sm">
                  <i class="fa-solid fa-trash me-1"></i> Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="py-10 text-center text-gray-400">
              <i class="fa-solid fa-box-open fa-2x mb-2"></i>
              <div>Data Kategori Kosong</div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
