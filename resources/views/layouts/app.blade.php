<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }} | @yield('title', 'Kasiran')</title>

  {{-- Vendor CSS --}}
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/js/select.dataTables.min.css') }}">

  {{-- Font Awesome 6 --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" />
</head>
<body>
  <div class="container-scroller">

    {{-- Navbar --}}
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <h2 class="m-3 text-primary fw-bold">{{ env('APP_NAME') }}</h2>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        {{-- Toggle sidebar --}}
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fa-solid fa-bars"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
              <img src="{{ asset('frontend/assets/images/faces/face28.jpg') }}" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="fa-solid fa-gear text-primary"></i> Settings
              </a>
              {{-- Logout --}}
              <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                @csrf
                <button type="submit" class="btn w-100 text-start bg-transparent border-0">
                  <i class="fa-solid fa-right-from-bracket text-primary"></i> Logout
                </button>
              </form>
            </div>
          </li>
        </ul>

        {{-- Offcanvas toggle --}}
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fa-solid fa-bars"></span>
        </button>
      </div>
    </nav>

    <div class="container-fluid page-body-wrapper">

      {{-- Sidebar --}}
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="fa-solid fa-gauge-high menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('Kategori.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('Kategori.index') }}">
              <i class="fa-solid fa-tags menu-icon"></i>
              <span class="menu-title">Kategori</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('Supplier.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('Supplier.index') }}">
              <i class="fa-solid fa-truck-field menu-icon"></i>
              <span class="menu-title">Supplier</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('Product.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('Product.index') }}">
              <i class="fa-solid fa-box-open menu-icon"></i>
              <span class="menu-title">Product</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('Stok.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('Stok.index') }}">
              <i class="fa-solid fa-database menu-icon"></i>
              <span class="menu-title">Kelola Stok</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('Transaksi.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('Transaksi.index') }}">
              <i class="fa-solid fa-credit-card menu-icon"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('kelolaTransaksi.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kelolaTransaksi.index') }}">
              <i class="fas fa-receipt menu-icon"></i>
              <span class="menu-title">Kelola Transaksi</span>
            </a>
          </li>
        </ul>
      </nav>

      {{-- Main Panel --}}
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              Copyright © 2025. Premium
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              Hand-crafted & made with <i class="fa-solid fa-heart text-danger ms-1"></i>
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  {{-- Scripts --}}
  <script src="{{ asset('frontend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendors/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/template.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/settings.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/todolist.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('frontend/assets/js/dashboard.js') }}"></script>
  @stack('scripts')
</body>
</html>
