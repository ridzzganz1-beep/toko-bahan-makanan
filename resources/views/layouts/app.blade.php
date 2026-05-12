<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Toko Bahan Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.4/css/all.min.css" integrity="sha512-xh6l8m5G1pS6CPo4eFqKx8cP7czVq9r2j6M7AqWUp5fUiyTkGTD6dv8QDW7pi6+S5K+xjG8ioKT+/2wOfQM71w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMX8UnOe1zLMRi+Jy7iT1DI8RUJXQOzJ1pIaxKIWlMSd0HdMDcpBBVUGaB0U4cPD3QXuRhEfJb9xrMJDrfqbA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq6DL0PR1rJnrOrj0iD8nSvP81feZngaxVXzdrW/Uf+8X1tYQ/dLd2PcKkxvYGMqskCENkQKjLjnelQhkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .glass { background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(14px); }
        .fade-in { animation: fadeIn 0.5s ease-out forwards; opacity: 0; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .sidebar-item.active { background: rgba(99, 102, 241, 0.18); border-right: 4px solid #6366f1; color: #c7d2fe; }
        .hover-scale { transition: transform 0.25s ease; }
        .hover-scale:hover { transform: scale(1.03); }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" @resize.window="sidebarOpen = window.innerWidth >= 1024">
    @auth
        @if(auth()->user()->role === 'admin')
            <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-950 border-r border-white/10 overflow-y-auto transition-transform duration-300 lg:block" :class="{ '-translate-x-full': !sidebarOpen }" style="z-index: 900;">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-indigo-500 to-sky-500 flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-leaf text-xl"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg text-white">Toko</h1>
                            <p class="text-xs text-slate-400">Bahan Makanan</p>
                        </div>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('admin.dashboard') ? 'text-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-chart-line w-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.barangs.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('admin.barangs.*') ? 'text-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-boxes w-5"></i>
                            <span class="font-medium">Data Barang</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('admin.orders.*') ? 'text-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-receipt w-5"></i>
                            <span class="font-medium">Transaksi</span>
                        </a>
                        <a href="{{ route('admin.reports') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('admin.reports') ? 'text-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-chart-pie w-5"></i>
                            <span class="font-medium">Laporan</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('admin.users.*') ? 'text-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium">User</span>
                        </a>
                    </nav>
                </div>

                <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-3xl text-slate-300 hover:bg-slate-800 transition-all">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </aside>
        @elseif(auth()->user()->role === 'user')
            <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-950 border-r border-white/10 overflow-y-auto transition-transform duration-300 lg:block" :class="{ '-translate-x-full': !sidebarOpen }" style="z-index: 900;">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg text-white">Toko</h1>
                            <p class="text-xs text-slate-400">Bahan Makanan</p>
                        </div>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('dashboard') ? 'text-emerald-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-home w-5"></i>
                            <span class="font-medium">Beranda</span>
                        </a>
                        <a href="{{ route('products.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('products.*') ? 'text-emerald-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-boxes w-5"></i>
                            <span class="font-medium">Produk</span>
                        </a>
                        <a href="{{ route('cart.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('cart.*') ? 'text-emerald-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-shopping-cart w-5"></i>
                            <span class="font-medium">Keranjang</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('orders.*') ? 'text-emerald-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-receipt w-5"></i>
                            <span class="font-medium">Riwayat Pesanan</span>
                        </a>
                        <a href="{{ route('profile.show') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-3xl transition-all {{ request()->routeIs('profile.*') ? 'text-emerald-200' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <i class="fas fa-user w-5"></i>
                            <span class="font-medium">Profil</span>
                        </a>
                    </nav>
                </div>

                <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-3xl text-slate-300 hover:bg-slate-800 transition-all">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </aside>
        @endif
    @endauth

    <!-- Mobile Overlay -->
    <div @click="sidebarOpen = false" :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }" class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="z-index: 800;"></div>

    <div class="lg:ml-72 transition-all duration-300" :class="{ 'ml-0': !sidebarOpen }">
        <!-- HEADER BARU -->
        <header style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:#1a1f36; border-bottom:1px solid #2d3561;">

          <div style="display:flex; align-items:center; gap:12px;">
            <!-- TOMBOL HAMBURGER -->
            @auth
            <button onclick="document.getElementById('sideMenu').classList.toggle('hidden')"
            style="color:white; font-size:22px; background:none; border:none; cursor:pointer;">&#9776;</button>
            @endauth

            <!-- JUDUL -->
            <span style="color:white; font-weight:bold; font-size:16px;">
              Toko Bahan Makanan
            </span>
          </div>

          <!-- TOMBOL LOGOUT -->
          @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:#6c63ff; color:white; border:none; padding:6px 16px; border-radius:20px; cursor:pointer;">Logout</button>
          </form>
          @endauth
        </header>

        <!-- SIDEBAR MENU -->
        <div id="sideMenu" class="hidden" style="position:fixed; top:0; left:0; width:70%; height:100vh; background:#1a1f36; z-index:999; padding:20px; box-shadow:4px 0 10px rgba(0,0,0,0.5);">

          <button onclick="document.getElementById('sideMenu').classList.add('hidden')"
          style="color:white; background:none; border:none; font-size:24px; float:right;">✕</button>

          <br><br>

          @auth
          @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            🏠 Dashboard</a>

            <a href="{{ route('admin.barangs.index') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            📦 Kelola Barang</a>

            <a href="{{ route('admin.users.index') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            👥 Kelola User</a>

            <a href="{{ route('admin.orders.index') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            🧾 Pesanan</a>
          @else
            <a href="{{ route('dashboard') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            🏠 Beranda</a>

            <a href="{{ route('products.index') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            🛒 Katalog</a>

            <a href="{{ route('orders.index') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            📋 Pesanan Saya</a>

            <a href="{{ route('profile.show') }}" style="display:block; color:white; padding:12px 0; border-bottom:1px solid #2d3561;">
            👤 Profil</a>
          @endif
          @endauth
        </div>

        <main class="p-6 min-h-screen">
            @if (session('success'))
                <div class="mb-6 rounded-3xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm text-emerald-100 shadow-lg fade-in" role="alert">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-3xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm text-rose-100 shadow-lg fade-in" role="alert">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-3xl border border-rose-500/20 bg-rose-500/10 p-4 text-sm text-rose-100 shadow-lg fade-in" role="alert">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle mt-1"></i>
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => alert.remove(), 300);
                }, 4000);
            });
        });
    </script>
</body>
</html>

