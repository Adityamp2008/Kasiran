@extends('layouts.app')
@section('title', 'Kelola Transaksi')

@section('content')
<div class="card p-3 border-0">
    <h5 class="mb-3 fw-semibold text-primary">
        <i class="fas fa-receipt me-2"></i> Kelola Transaksi
    </h5>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $trx)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $trx->product->supplier->nama_product ?? '-' }}</td>
                    <td class="text-center">{{ $trx->jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($trx->total,0,',','.') }}</td>
                    <td class="text-center">{{ $trx->created_at->format('d M Y ') }}</td>
                    <td class="text-center">
                        <a href="{{ route('kelolaTransaksi.print', $trx->id) }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
