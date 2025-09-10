@extends('layouts.app')
@section('title', 'Edit Transaksi')

@section('content')
<div class="max-w-screen-md mx-auto px-3 sm:px-6 py-6">
  <div class="bg-white p-5 rounded-xl shadow-md border">
    {{-- Header --}}
    <h5 class="text-lg font-semibold text-blue-600 mb-4 flex items-center">
      <i class="fas fa-edit mr-2"></i> Edit Transaksi
    </h5>

    <form action="{{ route('Transaksi.update', $transaksi->id) }}" method="POST" id="form-edit-transaksi" class="space-y-4">
      @csrf
      @method('PUT')

      {{-- Produk --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Produk</label>
        <select name="product_id"
                class="border border-gray-300 rounded-lg text-sm p-2 w-full focus:ring-2 focus:ring-blue-400"
                required>
          <option value="" disabled hidden>-- Pilih Produk --</option>
          @foreach($product as $p)
            <option value="{{ $p->id }}"
                    data-harga="{{ $p->harga_jual }}"
                    {{ $transaksi->product_id == $p->id ? 'selected' : '' }}>
              {{ $p->supplier->nama_product ?? '-' }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Jumlah --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah"
               class="border border-gray-300 rounded-lg text-sm p-2 w-full focus:ring-2 focus:ring-blue-400"
               value="{{ old('jumlah', $transaksi->jumlah) }}" min="1" required>
      </div>

      {{-- Harga & Total --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Satuan</label>
          <input type="text" id="harga"
                 class="border border-gray-300 rounded-lg text-sm p-2 w-full bg-gray-50 text-gray-700"
                 value="{{ $transaksi->product->harga_jual ?? 0 }}" readonly>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Total</label>
          <input type="text" id="total"
                 class="border border-gray-300 rounded-lg text-sm p-2 w-full bg-gray-50 text-gray-700 font-semibold"
                 value="{{ $transaksi->total }}" readonly>
        </div>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between pt-3">
        <a href="{{ route('Transaksi.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm flex items-center gap-1">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-sm flex items-center gap-1">
          <i class="fas fa-save"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const productSelect = document.querySelector('select[name="product_id"]');
  const jumlahInput   = document.getElementById('jumlah');
  const hargaInput    = document.getElementById('harga');
  const totalInput    = document.getElementById('total');

  function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
  }

  function hitungTotal() {
    const jumlah = parseInt(jumlahInput.value || 0);
    const harga  = parseFloat(hargaInput.dataset.value || hargaInput.value || 0);
    totalInput.value = formatRupiah(harga * jumlah);
  }

  productSelect.addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const harga = selected.dataset.harga || 0;
    hargaInput.dataset.value = harga;
    hargaInput.value = formatRupiah(harga);
    hitungTotal();
  });

  jumlahInput.addEventListener('input', hitungTotal);

  // Format awal saat load
  if (hargaInput.value) {
    hargaInput.dataset.value = hargaInput.value;
    hargaInput.value = formatRupiah(hargaInput.value);
    hitungTotal();
  }
});
</script>
@endpush
