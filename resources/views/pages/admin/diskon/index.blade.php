@extends('layouts.app')
@section('title', 'Manajemen Diskon')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="card-title">Daftar Diskon</h4>
                    <a href="{{ route('Diskon.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i> Tambah Diskon
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Diskon</th>
                                <th>Tipe</th>
                                <th>Nilai</th>
                                <th>Minimal Belanja</th>
                                <th>Minimal Qty</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($diskon as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_diskon }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($item->tipe) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->tipe == 'persen')
                                            {{ $item->nilai }}%
                                        @else
                                            Rp {{ number_format($item->nilai, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->min_belanja)
                                            Rp {{ number_format($item->min_belanja, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->min_qty ?? '-' }}</td>
                                    <td>
                                        @if($item->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('Diskon.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('Diskon.destroy', $item->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus diskon ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada diskon.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
