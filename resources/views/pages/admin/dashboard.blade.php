@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="px-4">

  <h1 class="mt-2 mb-4 text-xl font-bold text-blue-600 tracking-wide flex items-center">
    <i class="fa-solid fa-gauge-high mr-2 text-lg"></i> Dashboard
  </h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    {{-- Kategori --}}
    <div class="bg-white shadow-md rounded-xl p-3 flex items-center hover:shadow-lg hover:scale-[1.01] transition-all duration-200 cursor-pointer"
         data-count="{{ $kategoriCount }}">
      <div class="bg-blue-100 text-blue-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fa-solid fa-tags text-base"></i>
      </div>
      <div>
        <p class="text-xs text-gray-500 mb-1">Kategori</p>
        <p class="text-lg font-bold counter">0</p>
      </div>
    </div>

    {{-- Supplier --}}
    <div class="bg-white shadow-md rounded-xl p-3 flex items-center hover:shadow-lg hover:scale-[1.01] transition-all duration-200 cursor-pointer"
         data-count="{{ $supplierCount }}">
      <div class="bg-green-100 text-green-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fa-solid fa-truck-field text-base"></i>
      </div>
      <div>
        <p class="text-xs text-gray-500 mb-1">Supplier</p>
        <p class="text-lg font-bold counter">0</p>
      </div>
    </div>

    {{-- Produk --}}
    <div class="bg-white shadow-md rounded-xl p-3 flex items-center hover:shadow-lg hover:scale-[1.01] transition-all duration-200 cursor-pointer"
         data-count="{{ $produkCount }}">
      <div class="bg-yellow-100 text-yellow-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fa-solid fa-box-open text-base"></i>
      </div>
      <div>
        <p class="text-xs text-gray-500 mb-1">Produk</p>
        <p class="text-lg font-bold counter">0</p>
      </div>
    </div>

    {{-- Transaksi --}}
    <div class="bg-white shadow-md rounded-xl p-3 flex items-center hover:shadow-lg hover:scale-[1.01] transition-all duration-200 cursor-pointer"
         data-count="{{ $transaksiCount }}">
      <div class="bg-red-100 text-red-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fa-solid fa-receipt text-base"></i>
      </div>
      <div>
        <p class="text-xs text-gray-500 mb-1">Transaksi</p>
        <p class="text-lg font-bold counter">0</p>
      </div>
    </div>

  </div>
</div>

{{-- JS animasi counter --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
      const target = +counter.parentElement.parentElement.dataset.count;
      const increment = Math.max(1, Math.floor(target / 40)); // lebih cepat dikit
      const updateCount = () => {
        let count = +counter.innerText;
        if (count < target) {
          counter.innerText = Math.min(count + increment, target);
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target;
        }
      }
      updateCount();
    });
  });
</script>
@endsection
