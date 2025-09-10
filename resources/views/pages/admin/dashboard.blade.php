@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="px-4">

  <h1 class="mt-2 mb-6 text-2xl font-bold text-blue-600">Dashboard</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    {{-- Kategori --}}
    <div class="bg-white shadow rounded-lg p-4 flex items-center hover:shadow-lg transition cursor-pointer" data-count="{{ $kategoriCount }}">
      <div class="bg-blue-100 text-blue-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fas fa-list-alt fa-lg"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500 mb-1">Kategori</p>
        <p class="text-xl font-bold counter">0</p>
      </div>
    </div>

    {{-- Supplier --}}
    <div class="bg-white shadow rounded-lg p-4 flex items-center hover:shadow-lg transition cursor-pointer" data-count="{{ $supplierCount }}">
      <div class="bg-green-100 text-green-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fas fa-truck fa-lg"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500 mb-1">Supplier</p>
        <p class="text-xl font-bold counter">0</p>
      </div>
    </div>

    {{-- Produk --}}
    <div class="bg-white shadow rounded-lg p-4 flex items-center hover:shadow-lg transition cursor-pointer" data-count="{{ $produkCount }}">
      <div class="bg-yellow-100 text-yellow-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fas fa-box-open fa-lg"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500 mb-1">Produk</p>
        <p class="text-xl font-bold counter">0</p>
      </div>
    </div>

    {{-- Transaksi --}}
    <div class="bg-white shadow rounded-lg p-4 flex items-center hover:shadow-lg transition cursor-pointer" data-count="{{ $transaksiCount }}">
      <div class="bg-red-100 text-red-600 rounded-full p-3 flex-shrink-0 mr-3">
        <i class="fas fa-receipt fa-lg"></i>
      </div>
      <div>
        <p class="text-sm text-gray-500 mb-1">Transaksi</p>
        <p class="text-xl font-bold counter">0</p>
      </div>
    </div>

  </div>
</div>

{{-- JS animasi counter --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.parentElement.parentElement.dataset.count;
        const count = +counter.innerText;
        const increment = target / 50;
        if(count < target){
          counter.innerText = Math.ceil(count + increment);
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
