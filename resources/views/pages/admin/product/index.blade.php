@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>
    <a href="{{ route('Product.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Stok Minimal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Product as $product)
                <tr>
                    <td class="py-3">{{ $loop->iteration }}</td>
                    <td>{{ $product->kategori->nama ?? '-' }}</td>
                    <td>{{ $product->supplier->nama_supplier ?? '-' }}</td>
                    <td>{{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                    <td>{{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>{{ $product->stok_minimal }}</td>
                    <td>
                        <a href="{{ route('Product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('Product.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
