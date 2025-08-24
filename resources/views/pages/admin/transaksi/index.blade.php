@extends('layouts.app')
@section('title', 'Transaksi Kasir')

@section('content')
<div class="row">

    <!-- Form Tambah Transaksi -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card border-0 p-3">
            <h5 class="mb-3 fw-semibold text-success">
                <i class="fas fa-plus-circle me-2"></i> Tambah Transaksi
            </h5>

            <form action="{{ route('Transaksi.store') }}" method="POST">
                @csrf

                {{-- Produk --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Produk</label>
                    <select name="product_id" class="form-select form-select-sm" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($product as $p)
                            @if($p->supplier)
                            <option value="{{ $p->id }}" data-harga="{{ $p->harga_jual }}" data-stok="{{ $p->stok }}">
                                {{ $p->supplier->nama_product }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="text-danger small mt-1" id="stok-warning" style="display: none;">
                        Stok tidak mencukupi!
                    </div>
                </div>

                {{-- Jumlah & Total --}}
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control form-control-sm" value="1" min="1" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Harga / Total</label>
                        <input type="text" id="harga" class="form-control form-control-sm mb-2" placeholder="Harga" readonly>
                        <input type="text" id="total" class="form-control form-control-sm" placeholder="Total" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm w-100">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Transaksi -->
    <div class="col-lg-8 col-12">
        <div class="card border-0 p-3">
            <h5 class="mb-3 fw-semibold text-primary">
                <i class="fas fa-list-alt me-2"></i> Daftar Transaksi
            </h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:5%">#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th style="width:15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $trx)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $trx->product->supplier->nama_product ?? '-' }}</td>
                            <td class="text-center">{{ $trx->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($trx->total,0,',','.') }}</td>
                            <td class="text-center">{{ $trx->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('Transaksi.edit', $trx->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i class="fas fa-info-circle me-1"></i> Belum ada transaksi
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.querySelector('select[name="product_id"]');
    const jumlahInput = document.getElementById('jumlah');
    const hargaInput = document.getElementById('harga');
    const totalInput = document.getElementById('total');
    const stokWarning = document.getElementById('stok-warning');

    let stokTersedia = 0;

    function hitungTotal() {
        const jumlah = parseInt(jumlahInput.value || 0);
        const harga = parseFloat(hargaInput.value || 0);
        totalInput.value = harga * jumlah;

        if (jumlah > stokTersedia) {
            stokWarning.style.display = 'block';
        } else {
            stokWarning.style.display = 'none';
        }
    }

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        hargaInput.value = selectedOption.dataset.harga || 0;
        stokTersedia = parseInt(selectedOption.dataset.stok || 0);
        hitungTotal();
    });

    jumlahInput.addEventListener('input', hitungTotal);
});
</script>
@endpush
