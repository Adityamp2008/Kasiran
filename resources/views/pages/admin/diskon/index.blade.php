@extends('layouts.app')
@section('title', 'Manajemen Diskon')

@section('content')
<div class="mt-6 max-w-6xl mx-auto px-4 space-y-4">

  {{-- Header --}}
  <div class="flex justify-between items-center">
    <h2 class="text-2xl font-bold text-blue-600 flex items-center">
      <i class="fa-solid fa-percent me-2"></i> Daftar Diskon
    </h2>
    <a href="{{ route('Diskon.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center text-sm">
      <i class="fa-solid fa-plus me-2"></i> Tambah Diskon
    </a>
  </div>

  @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded transition">
      {{ session('success') }}
    </div>
  @endif

  {{-- Table --}}
  <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
    <table class="min-w-full text-sm divide-y divide-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 text-left font-medium text-gray-600">#</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Nama Diskon</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Tipe</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Nilai</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Minimal Belanja</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Minimal Qty</th>
          <th class="px-3 py-2 text-center font-medium text-gray-600">Status</th>
          <th class="px-3 py-2 text-center font-medium text-gray-600">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($diskon as $item)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-3 py-2">{{ $loop->iteration }}</td>
            <td class="px-3 py-2 font-medium">{{ $item->nama_diskon }}</td>
            <td class="px-3 py-2">
              <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                {{ ucfirst($item->tipe) }}
              </span>
            </td>
            <td class="px-3 py-2">
              @if($item->tipe == 'persen')
                {{ $item->nilai }}%
              @else
                Rp {{ number_format($item->nilai, 0, ',', '.') }}
              @endif
            </td>
            <td class="px-3 py-2">
              {{ $item->min_belanja ? 'Rp '.number_format($item->min_belanja,0,',','.') : '-' }}
            </td>
            <td class="px-3 py-2">{{ $item->min_qty ?? '-' }}</td>
            
            {{-- Tombol Aktif/Nonaktif --}}
            <td class="px-3 py-2 text-center">
              <form action="{{ route('Diskon.toggle', $item->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="px-2 py-1 rounded-full text-xs font-semibold
                           {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                  {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                </button>
              </form>
            </td>

            {{-- Aksi: Edit & Hapus --}}
            <td class="px-3 py-2 text-center space-x-1">
              <a href="{{ route('Diskon.edit', $item->id) }}" 
                 class="inline-flex items-center bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 hover:shadow text-xs">
                <i class="fa-solid fa-pen me-1"></i>
              </a>
              <form action="{{ route('Diskon.destroy', $item->id) }}" method="POST" class="inline" 
                    onsubmit="return confirm('Yakin ingin menghapus diskon ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 hover:shadow text-xs">
                  <i class="fa-solid fa-trash me-1"></i>
                </button>
              </form>
            </td>

          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center py-6 text-gray-400">
              <i class="fa-solid fa-box-open fa-lg mb-1 block"></i>
              Belum ada diskon.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
