@extends('layouts.app')
@section('title', 'Manajemen Supplier')

@section('content')
<div class="space-y-4">

  {{-- Header + tombol tambah --}}
  <div class="flex justify-between items-center">
    <h2 class="text-lg font-bold text-blue-600 flex items-center">
      <i class="fa-solid fa-truck-field mr-2 text-blue-500"></i> Daftar Supplier
    </h2>
    <a href="{{ route('Supplier.create') }}" 
       class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 hover:shadow transition flex items-center text-sm">
      <i class="fa-solid fa-plus mr-2"></i> Tambah
    </a>
  </div>

  {{-- Table --}}
  <div class="bg-white shadow-md rounded-xl p-4 overflow-x-auto">
    <table class="min-w-full border border-gray-100 rounded-lg overflow-hidden text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 text-left font-medium text-gray-600">No</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Nama Supplier</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Nama Produk</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Kontak</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Alamat</th>
          <th class="px-3 py-2 text-center font-medium text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($Supplier as $item)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-3 py-2">{{ $loop->iteration }}</td>
            <td class="px-3 py-2 font-medium">{{ $item->nama_supplier }}</td>
            <td class="px-3 py-2">{{ $item->nama_product }}</td>
            <td class="px-3 py-2">{{ $item->kontak }}</td>
            <td class="px-3 py-2">{{ $item->alamat }}</td>
            <td class="px-3 py-2 text-center space-x-1">
              <a href="{{ route('Supplier.edit', $item->id) }}" 
                 class="inline-flex items-center bg-yellow-400 text-white px-2 py-1 rounded-md hover:bg-yellow-500 hover:shadow transition-all text-xs">
                <i class="fa-solid fa-pen mr-1"></i> Edit
              </a>
              <form action="{{ route('Supplier.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Anda yakin ingin menghapus supplier ini?')" 
                        class="inline-flex items-center bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-700 hover:shadow transition-all text-xs">
                  <i class="fa-solid fa-trash mr-1"></i> Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="py-8 text-center text-gray-400">
              <i class="fa-solid fa-box-open fa-lg mb-1 block"></i>
              <span class="text-sm">Belum ada data supplier</span>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
