@extends('layouts.app')
@section('title', 'Transaksi Multi-Item')

@section('content')
<div class="max-w-screen-lg mx-auto px-3 sm:px-6 py-6">
    <div class="bg-white p-5 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-cash-register text-blue-500 mr-2"></i> Buat Transaksi
        </h2>

        <form action="{{ route('Transaksi.store') }}" method="POST" id="form-transaksi" class="space-y-4">
            @csrf

            <div id="produk-wrapper" class="space-y-3">
                {{-- ITEM TEMPLATE --}}
                <div class="produk-item grid grid-cols-1 sm:grid-cols-5 gap-3 bg-gray-50 p-4 rounded-lg border relative">
                    {{-- Produk --}}
                    <select name="product_id[]" class="product-select border rounded-lg text-sm p-2" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($product as $p)
                            @if($p->supplier)
                                <option value="{{ $p->id }}" 
                                        data-harga="{{ $p->harga_jual }}" 
                                        data-stok="{{ $p->stok }}">
                                    {{ $p->supplier->nama_product }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    {{-- Jumlah --}}
                    <input type="number" name="jumlah[]" class="jumlah border rounded-lg text-sm p-2" value="1" min="1" required>

                    {{-- Harga --}}
                    <input type="text" class="harga border rounded-lg text-sm p-2 bg-gray-100" readonly>

                    {{-- Subtotal --}}
                    <input type="text" class="subtotal border rounded-lg text-sm p-2 bg-gray-100" readonly>

                    {{-- Tombol Hapus --}}
                    <button type="button" class="btn-remove hidden text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            {{-- Grand Total --}}
            <div class="text-lg font-semibold text-gray-800">
                Grand Total: <span id="grand-total" class="text-blue-600">Rp 0</span>
            </div>

            {{-- Hidden input untuk kirim grand total ke backend --}}
            <input type="hidden" name="grand_total" id="grand_total_input" value="0">

            <div class="flex gap-3">
                <button type="button" id="add-produk" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>
                <button type="submit" id="btn-submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('produk-wrapper');
    const grandTotalEl = document.getElementById('grand-total');
    const grandTotalInput = document.getElementById('grand_total_input');
    const btnSubmit = document.getElementById('btn-submit');
    const firstItem = wrapper.querySelector('.produk-item');

    function formatRupiah(n) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(n);
    }

    function hitungTotal() {
        let total = 0;
        let adaProduk = false;

        wrapper.querySelectorAll('.produk-item').forEach(item => {
            const select = item.querySelector('.product-select');
            const harga = parseFloat(select.selectedOptions[0]?.dataset.harga || 0);
            const jumlah = parseInt(item.querySelector('.jumlah').value || 0);
            const subtotal = harga * jumlah;

            if (select.value) adaProduk = true;

            item.querySelector('.harga').value = harga ? formatRupiah(harga) : '';
            item.querySelector('.subtotal').value = subtotal ? formatRupiah(subtotal) : '';

            total += subtotal;
        });

        grandTotalEl.innerText = formatRupiah(total);
        grandTotalInput.value = total;
        btnSubmit.disabled = !adaProduk; // disable submit jika belum ada produk dipilih
    }

    function initItem(item) {
        const select = item.querySelector('.product-select');
        const jumlah = item.querySelector('.jumlah');
        const btnRemove = item.querySelector('.btn-remove');

        select.onchange = null;
        jumlah.oninput = null;
        btnRemove.onclick = null;

        select.addEventListener('change', hitungTotal);
        jumlah.addEventListener('input', hitungTotal);
        btnRemove.addEventListener('click', () => {
            if (wrapper.querySelectorAll('.produk-item').length > 1) {
                item.remove();
                hitungTotal();
            }
        });
    }

    initItem(firstItem);

    document.getElementById('add-produk').addEventListener('click', () => {
        const clone = firstItem.cloneNode(true);

        clone.classList.add('opacity-0', 'transition', 'duration-300');
        clone.querySelector('.product-select').value = '';
        clone.querySelector('.jumlah').value = 1;
        clone.querySelector('.harga').value = '';
        clone.querySelector('.subtotal').value = '';
        clone.querySelector('.btn-remove').classList.remove('hidden');

        wrapper.appendChild(clone);
        initItem(clone);
        hitungTotal();

        setTimeout(() => clone.classList.remove('opacity-0'), 10);
    });

    hitungTotal();
});
</script>
@endpush
