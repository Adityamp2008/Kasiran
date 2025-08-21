@extends('layouts.app')
@section('title', 'Daftar Produk')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Produk</h4>
                <a href="{{ route('Product.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Produk
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Status</th> {{-- Kolom baru --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Product as $index => $product)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->kategori->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $product->stok }}</td>
                                    
                                    {{-- Status stok pakai badge --}}
                                    <td class="text-center">
                                        @if($product->stok <= $product->stok_minimal)
                                            <span class="badge bg-danger">Habis</span>
                                        @else
                                            <span class="badge bg-success">Aman</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('Product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('Product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
