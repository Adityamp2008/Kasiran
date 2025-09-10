@extends('layouts.app')
@section('title', 'Riwayat Transaksi Kasir')

@section('content')
<div class="max-w-screen-xl mx-auto px-2 sm:px-4 py-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-5">
        <h4 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-list-alt mr-2 text-blue-500"></i> Riwayat Transaksi
        </h4>
        <a href="{{ route('Transaksi.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-1 shadow-sm">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
    </div>

    {{-- Card Table --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-xs font-semibold text-gray-600 text-center uppercase">
                    <th class="px-3 py-3">No</th>
                    <th class="px-3 py-3 text-left">Produk</th>
                    <th class="px-3 py-3">Jumlah</th>
                    <th class="px-3 py-3">Subtotal</th>
                    <th class="px-3 py-3">Potongan</th>
                    <th class="px-3 py-3">Total</th>
                    <th class="px-3 py-3">Tanggal</th>
                    <th class="px-3 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($transaksi as $trx)
                <tr class="hover:bg-blue-50 transition">
                    {{-- Nomor --}}
                    <td class="px-3 py-2 text-center font-medium text-gray-700">
                        {{ $loop->iteration }}
                    </td>

                    {{-- Produk --}}
                    <td class="px-3 py-2">
                        @forelse($trx->details as $detail)
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full mr-1 mb-1">
                                {{ $detail->product->supplier->nama_product ?? $detail->product->nama_product ?? 'Produk' }}
                            </span>
                        @empty
                            <span class="text-gray-400">Tidak ada detail</span>
                        @endforelse
                    </td>

                    {{-- Jumlah --}}
                    <td class="px-3 py-2 text-center">
                        {{ $trx->details->sum('jumlah') }}
                    </td>

                    {{-- Subtotal --}}
                    <td class="px-3 py-2 text-right">
                        Rp {{ number_format($trx->details->sum('subtotal'), 0, ',', '.') }}
                    </td>

                    {{-- Potongan --}}
                    <td class="px-3 py-2 text-right text-red-600">
                        Rp {{ number_format(optional($trx->diskon)->nilai ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- Total --}}
                    <td class="px-3 py-2 text-right font-semibold text-green-700">
                        Rp {{ number_format($trx->total, 0, ',', '.') }}
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-3 py-2 text-center">
                        {{ $trx->created_at->format('d M Y H:i') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="px-3 py-2 text-center">
                        <div class="flex justify-center gap-1 flex-wrap">
                            <a href="{{ route('Transaksi.edit', $trx->id) }}" 
                               class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded hover:bg-yellow-200 transition text-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('Transaksi.destroy', $trx->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200 transition text-sm" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <a href="{{ route('Transaksi.print', $trx->id) }}" 
                               class="bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200 transition text-sm" title="Print">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-3 py-6 text-center text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i> Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
