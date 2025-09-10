  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title', 'Kasiran') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  </head>
  <body class="bg-gray-100 text-gray-800 flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-gray-100 h-screen flex flex-col">
      <div class="p-6 text-center text-2xl font-bold text-blue-400">{{ env('APP_NAME') }}</div>
      <nav class="flex-1 px-4">
        <ul class="space-y-2">
          <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-gauge-high w-6"></i>
              <span class="ml-2">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Kategori.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-tags w-6"></i>
              <span class="ml-2">Kategori</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Supplier.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-truck-field w-6"></i>
              <span class="ml-2">Supplier</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Product.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-box-open w-6"></i>
              <span class="ml-2">Product</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Stok.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-database w-6"></i>
              <span class="ml-2">Kelola Stok</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Transaksi.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-credit-card w-6"></i>
              <span class="ml-2">Transaksi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('Diskon.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800 transition">
              <i class="fa-solid fa-percent w-6"></i>
              <span class="ml-2">Diskon</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-h-screen">
      {{-- Navbar --}}
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <div>
          <button id="sidebarToggle" class="text-gray-700 md:hidden">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
        <div class="flex items-center space-x-4">
          <span class="hidden md:inline font-semibold">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
          <div class="relative">
            <button id="profileDropdownBtn" class="p-2 rounded hover:bg-gray-200 transition">
              <i class="fa-solid fa-user"></i>
            </button>
            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow">
              <a href="{{ route('setting.index') }}" class="flex items-center p-2 hover:bg-gray-100">
                <i class="fa-solid fa-gear w-4 mr-2 text-blue-600"></i> Settings
              </a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 hover:bg-gray-100 text-left">
                  <i class="fa-solid fa-right-from-bracket w-4 mr-2 text-red-600"></i> Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </header>

      {{-- Content --}}
      <main class="flex-1 p-2">
        @yield('content')
      </main>

      {{-- Footer --}}
      <footer class="bg-white p-4 shadow text-center text-gray-500">
        &copy; 2025. Premium
      </footer>
    </div>

    {{-- JS Interaksi --}}
    <script>
      const dropdownBtn = document.getElementById('profileDropdownBtn');
      const dropdown = document.getElementById('profileDropdown');
      dropdownBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
      });

      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebar = document.querySelector('aside');
      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
      });
    </script>

  </body>
  </html>
