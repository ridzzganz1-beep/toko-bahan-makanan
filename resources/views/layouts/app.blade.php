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
<body class="bg-slate-950 text-slate-100 font-sans" x-data="{ sidebarOpen: true }">
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
        @endif
    @endauth

    <div class="lg:ml-72 transition-all duration-300" :class="{ 'ml-0': !sidebarOpen }">
        <nav class="sticky top-0 z-40 glass border-b border-white/10 shadow-lg">
            <div class="px-6 py-4 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-300 hover:text-white transition-colors">
                        <i class="fas fa-bars w-6 h-6"></i>
                    </button>
                    <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="font-semibold text-white text-lg">Toko Bahan Makanan</a>
                </div>

                <div class="flex-1 hidden lg:flex items-center justify-center">
                    <div class="w-full max-w-2xl bg-slate-900/70 border border-white/10 rounded-full px-4 py-2 flex items-center gap-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input type="text" placeholder="Cari produk..." class="w-full bg-transparent text-slate-200 placeholder-slate-500 outline-none" />
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->role === 'user')
                        <div class="hidden md:flex items-center gap-2 rounded-full bg-slate-900/70 px-3 py-2 border border-white/10">
                            <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white">Home</a>
                            <span class="text-slate-500">•</span>
                            <a href="{{ route('products.index') }}" class="text-slate-300 hover:text-white">Produk</a>
                            <span class="text-slate-500">•</span>
                            <a href="{{ route('cart.index') }}" class="text-slate-300 hover:text-white">Keranjang</a>
                            <span class="text-slate-500">•</span>
                            <a href="{{ route('orders.index') }}" class="text-slate-300 hover:text-white">Riwayat</a>
                        </div>
                        @endif
                        <div class="flex items-center gap-3">
                            <a href="{{ route('profile.show') }}" class="hidden md:flex items-center gap-2 rounded-full bg-slate-900/70 px-3 py-2 border border-white/10 text-slate-300 hover:text-white">
                                <i class="fas fa-user-circle"></i>
                                Profil
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-indigo-500/90 px-4 py-2 text-white hover:bg-indigo-400 transition-all">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

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

