<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name') }} | @yield('title', 'Kasiran')</title>
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/js/select.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css')}}">
  <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png')}}" />
</head>
<body>
  <div class="container-scroller">
    {{-- Navbar --}}
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

        <h2 class="m-3 text-primary font-weight-bold">{{env('APP_NAME')}}</h2>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('frontend/assets/images/faces/face28.jpg') }}" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="ti-settings text-primary"></i> Settings
              </a>
              {{-- Tombol Logout --}}
              <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                @csrf
                <button type="submit" class="w-full text-start bg-transparent border-0 ">
                  <i class="ti-power-off text-primary"></i> Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
      {{-- Sidebar --}}
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('Kategori.*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('Kategori.index') }}">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Kategori</span>
              </a>
            </li>
          <li class="nav-item {{ request()->routeIs('Supplier.*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('Supplier.index') }}">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">supplier</span>
              </a>
            </li>
          <li class="nav-item {{ request()->routeIs('Product.*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('Product.index') }}">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Product</span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
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
              Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i>
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>



  {{-- Scripts --}}
  <script src="{{ asset('frontend/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendors/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/dataTables.select.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/off-canvas.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/template.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/settings.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/todolist.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="{{ asset('frontend/assets/js/dashboard.js')}}"></script>
  @stack('scripts')
</body>
</html>
