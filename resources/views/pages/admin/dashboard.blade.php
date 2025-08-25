@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 fw-bold text-primary">Dashboard</h1>

    <div class="row g-4">
        {{-- Kategori --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="icon bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                        <i class="fas fa-list-alt fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Kategori</h6>
                        <h4 class="fw-bold mb-0">{{ $kategoriCount }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Supplier --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="icon bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                        <i class="fas fa-truck fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Supplier</h6>
                        <h4 class="fw-bold mb-0">{{ $supplierCount }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="icon bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Produk</h6>
                        <h4 class="fw-bold mb-0">{{ $produkCount }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaksi --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="icon bg-danger bg-opacity-10 text-danger rounded-circle p-3 me-3">
                        <i class="fas fa-receipt fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Transaksi</h6>
                        <h4 class="fw-bold mb-0">{{ $transaksiCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
