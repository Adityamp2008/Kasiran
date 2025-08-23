@extends('layouts.app')
@section('title', 'Manajemen Supplier')

@section('content')
<div class="row">
    <!-- Tabel Daftar Supplier -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Supplier</h4>
                <a href="{{ route('Supplier.create') }}" class="btn btn-primary btn-icon-text">
                    <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Supplier
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr class="border-bottom">
                            <th class="font-weight-bold">No</th>
                            <th class="font-weight-bold">Nama Supplier</th>
                            <th class="font-weight-bold">Nama Product</th>
                            <th class="font-weight-bold">Kontak</th>
                            <th class="font-weight-bold">Alamat</th>
                            <th class="font-weight-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Supplier as $item)
                            <tr class="border-bottom">
                                <td class="py-3">{{ $loop->iteration }}</td>
                                <td class="py-3">{{ $item->nama_supplier }}</td>
                                <td class="py-3">{{ $item->nama_product }}</td>
                                <td class="py-3">{{ $item->kontak }}</td>
                                <td class="py-3">{{ $item->alamat }}</td>
                                <td class="py-3 text-center">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('Supplier.edit', $item->id) }}" class="btn btn-warning btn-sm btn-icon-text" title="Edit">
                                    Edit
                                    </a>           

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('Supplier.destroy', $item->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm btn-icon-text text-white" 
                                                onclick="return confirm('Anda yakin ingin menghapus supplier ini?')" 
                                                title="Hapus">
                                                Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center py-5">
                                        <i class="mdi mdi-inbox-arrow-down-outline mdi-48px text-muted"></i>
                                        <h5 class="mt-3">Data Supplier Kosong</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
