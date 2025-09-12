@extends('layouts.app')
@section('title', 'Edit Transaksi')

@section('content')
<div class="max-w-screen-lg mx-auto px-3 sm:px-6 py-6">
    <div class="bg-white p-5 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-edit text-blue-500 mr-2"></i> Edit Transaksi
        </h2>

        <form action="{{ route('Transaksi.update', $transaksi->id) }}" method="POST" id="form-edit-transaksi" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Wrapper produk --}}
            <div id="produk-wrapper" class="space-y-3">
                @foreach($transaksi->details as $detail)
                <div class="produk-item grid grid-cols-1 sm:grid-cols-5 gap-3 bg-gray-50 p-4 rounded-lg border relative">
                    {{-- Pilih Produk --}}
                    <select name="product_id[]" class="product-select border rounded-lg text-sm p-2" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($product as $p)
                            <option value="{{ $p->id }}" data-harga="{{ $p->harga_jual }}"
                                {{ $p->id == $detail->product_id ? 'selected' : '' }}>
                                {{ $p->supplier->nama_product ?? '-' }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Jumlah --}}
                    <input type="number" name="jumlah[]" class="jumlah border rounded-lg text-sm p-2" value="{{ $detail->jumlah }}" min="1" required>

                    {{-- Harga --}}
                    <input type="text" class="harga border rounded-lg text-sm p-2 bg-gray-100" value="{{ $detail->harga }}" readonly>

                    {{-- Subtotal --}}
                    <input type="text" class="subtotal border rounded-lg text-sm p-2 bg-gray-100" value="{{ $detail->subtotal }}" readonly>

                    {{-- Tombol hapus --}}
                    <button type="button" class="btn-remove text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                @endforeach
            </div>

            {{-- Grand Total --}}
            <div class="text-lg font-semibold text-gray-800">
                Grand Total: <span id="grand-total" class="text-blue-600">Rp {{ number_format($transaksi->total,0,',','.') }}</span>
            </div>
            <input type="hidden" name="grand_total" id="grand_total_input" value="{{ $transaksi->total }}">

            <div class="flex gap-3">
                <button type="button" id="add-produk" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-save"></i> Update Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('produk-wrapper');
    const addBtn = document.getElementById('add-produk');
    const grandTotalSpan = document.getElementById('grand-total');
    const grandTotalInput = document.getElementById('grand_total_input');

    function formatRupiah(angka) {
        return `Rp ${parseInt(angka).toLocaleString()}`;
    }

    function updateTotals() {
        let grandTotal = 0;
        wrapper.querySelectorAll('.produk-item').forEach(item => {
            const selectProduk = item.querySelector('.product-select');
            const jumlahInput = item.querySelector('.jumlah');
            const hargaInput = item.querySelector('.harga');
            const subtotalInput = item.querySelector('.subtotal');

            const selectedOption = selectProduk.selectedOptions[0];
            const harga = selectedOption ? parseInt(selectedOption.dataset.harga) : 0;
            const qty = parseInt(jumlahInput.value) || 0;
            const subtotal = harga * qty;

            hargaInput.value = harga ? formatRupiah(harga) : '';
            subtotalInput.value = subtotal ? formatRupiah(subtotal) : '';

            grandTotal += subtotal;
        });

        grandTotalSpan.textContent = formatRupiah(grandTotal);
        grandTotalInput.value = grandTotal;
    }

    function attachEvents(item) {
        item.querySelector('.product-select').addEventListener('change', updateTotals);
        item.querySelector('.jumlah').addEventListener('input', updateTotals);
        item.querySelector('.btn-remove').addEventListener('click', () => {
            item.remove();
            updateTotals();
        });
    }

    // Attach events ke semua item yang ada
    wrapper.querySelectorAll('.produk-item').forEach(item => attachEvents(item));

    // Tambah produk baru
    addBtn.addEventListener('click', () => {
        const firstItem = wrapper.querySelector('.produk-item');
        const clone = firstItem.cloneNode(true);

        // reset clone
        clone.querySelector('.product-select').value = '';
        clone.querySelector('.jumlah').value = 1;
        clone.querySelector('.harga').value = '';
        clone.querySelector('.subtotal').value = '';
        clone.querySelector('.btn-remove').classList.remove('hidden');

        wrapper.appendChild(clone);
        attachEvents(clone);
        updateTotals();
    });

    updateTotals();
});
</script>
@endsection
