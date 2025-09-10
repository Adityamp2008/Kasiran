    @extends('layouts.app')
    @section('title', 'Manajemen Supplier')

    @section('content')
    <div class="space-y-6">

    {{-- Header + tombol tambah --}}
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold text-blue-600">Daftar Supplier</h2>
        <a href="{{ route('Supplier.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
        <i class="fa-solid fa-plus me-2"></i> Tambah Supplier
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama Supplier</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama Product</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Kontak</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Alamat</th>
            <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($Supplier as $item)
            <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $item->nama_supplier }}</td>
            <td class="px-4 py-2">{{ $item->nama_product }}</td>
            <td class="px-4 py-2">{{ $item->kontak }}</td>
            <td class="px-4 py-2">{{ $item->alamat }}</td>
            <td class="px-4 py-2 text-center space-x-1">
                <a href="{{ route('Supplier.edit', $item->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition text-sm">
                Edit
                </a>
                <form action="{{ route('Supplier.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Anda yakin ingin menghapus supplier ini?')" 
                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 transition text-sm">
                    Hapus
                </button>
                </form>
            </td>
            </tr>
            @empty
            <tr>
            <td colspan="6" class="py-10 text-center text-gray-400">
                <i class="fa-solid fa-box-open fa-2x mb-2"></i>
                <div>Data Supplier Kosong</div>
            </td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    </div>
    @endsection
