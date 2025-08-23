@extends('layouts.app')
@section('title', 'Transaksi Kasir')

@section('content')
<div class="row">

    <!-- Form Tambah Transaksi -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">🛒 Tambah Transaksi</h5>

                <form action="{{ route('Transaksi.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Produk --}}
                    <div class="mb-2">
                        <label class="form-label">Produk</label>
                        <select name="product_id" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($product as $p)
                                @if($p->supplier)
                                <option value="{{ $p->id }}" data-harga="{{ $p->harga_jual }}">
                                    {{ $p->supplier->nama_product }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah & Total --}}
                    <div class="mb-2 row">
                        <div class="col-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" class="form-control form-control-sm" value="1" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Harga / Total</label>
                            <input type="text" id="harga" class="form-control form-control-sm mb-1" placeholder="Harga" readonly>
                            <input type="text" id="total" class="form-control form-control-sm" placeholder="Total" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Transaksi -->
    <div class="col-lg-8 col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">📑 Daftar Transaksi</h5>

                <table class="table table-sm table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->product->supplier->nama_product ?? '-' }}</td>
                            <td>{{ $trx->jumlah }}</td>
                            <td>Rp {{ number_format($trx->total,0,',','.') }}</td>
                            <td>{{ $trx->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('Transaksi.edit', $trx->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('Transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
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

    function hitungTotal() {
        const harga = parseFloat(hargaInput.value || 0);
        const jumlah = parseInt(jumlahInput.value || 0);
        totalInput.value = harga * jumlah;
    }

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        hargaInput.value = selectedOption.dataset.harga || 0;
        hitungTotal();
    });

    jumlahInput.addEventListener('input', hitungTotal);
});
</script>
@endpush
