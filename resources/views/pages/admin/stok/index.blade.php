@extends('layouts.app')
@section('title', 'Kelola Stok Produk')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Stok Produk</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga Jual</th>
                                <th>Stok Saat Ini</th>
                                <th>Minimal Stok</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Update</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Product as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->supplier->nama_product ?? '-' }}</td>
                                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->stok_minimal }}</td>
                                    <td>
                                        @if($item->stok <= $item->stok_minimal)
                                            <span class="badge bg-danger">Habis</span>
                                        @else
                                            <span class="badge bg-success">Aman</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->lokasi ?? '-' }}</td>
                                    <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('Stok.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="mdi mdi-pencil-outline"></i> Penyesuaian
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @if($Product->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="mdi mdi-inbox-arrow-down-outline mdi-48px text-muted"></i>
                                        <p class="mt-2">Belum ada produk</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
