@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-gradient-to-r from-indigo-600 to-sky-600 p-8 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}</h2>
                <p class="text-indigo-100">Kelola data barang, transaksi, dan pelanggan toko bahan makanan Anda dengan mudah.</p>
            </div>
            <div class="hidden md:block text-6xl opacity-20"><i class="fas fa-leaf"></i></div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="group rounded-[2rem] glass border border-white/10 p-6 shadow-xl hover:-translate-y-1 transition-transform">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Total Barang</p>
                    <p class="text-4xl font-bold text-white">{{ $barangCount }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 flex items-center justify-center group-hover:bg-indigo-500/30 transition-colors">
                    <i class="fas fa-boxes text-2xl text-indigo-400"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.barangs.index') }}" class="text-sky-400 hover:text-sky-300 text-sm font-semibold flex items-center gap-2 transition-colors">
                    Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <div class="group rounded-[2rem] glass border border-white/10 p-6 shadow-xl hover:-translate-y-1 transition-transform">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Total Pesanan</p>
                    <p class="text-4xl font-bold text-white">{{ $orderCount }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-sky-500/20 flex items-center justify-center group-hover:bg-sky-500/30 transition-colors">
                    <i class="fas fa-receipt text-2xl text-sky-400"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.orders.index') }}" class="text-sky-400 hover:text-sky-300 text-sm font-semibold flex items-center gap-2 transition-colors">
                    Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <div class="group rounded-[2rem] glass border border-white/10 p-6 shadow-xl hover:-translate-y-1 transition-transform">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Total Pelanggan</p>
                    <p class="text-4xl font-bold text-white">{{ $userCount }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <i class="fas fa-users text-2xl text-emerald-400"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.users.index') }}" class="text-sky-400 hover:text-sky-300 text-sm font-semibold flex items-center gap-2 transition-colors">
                    Kelola User <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <div class="group rounded-[2rem] glass border border-white/10 p-6 shadow-xl hover:-translate-y-1 transition-transform">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium mb-1">Status</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                        <p class="text-xl font-semibold text-white">Online</p>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <i class="fas fa-check-circle text-2xl text-emerald-400"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-white/10">
                <p class="text-emerald-400 text-sm font-semibold">Sistem Normal</p>
            </div>
        </div>
    </div>

    <div class="rounded-[2rem] glass border border-white/10 p-6 shadow-lg">
        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-yellow-400"></i>
            Tautan Cepat
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.barangs.index') }}" class="rounded-xl bg-slate-800/50 hover:bg-indigo-500/20 border border-white/10 p-4 text-center transition-all group">
                <div class="text-2xl mb-2 text-indigo-400 group-hover:scale-110 transition-transform"><i class="fas fa-list"></i></div>
                <p class="text-sm text-slate-300 group-hover:text-white transition-colors">Lihat Barang</p>
            </a>
            <a href="{{ route('admin.barangs.create') }}" class="rounded-xl bg-slate-800/50 hover:bg-sky-500/20 border border-white/10 p-4 text-center transition-all group">
                <div class="text-2xl mb-2 text-sky-400 group-hover:scale-110 transition-transform"><i class="fas fa-plus"></i></div>
                <p class="text-sm text-slate-300 group-hover:text-white transition-colors">Tambah Barang</p>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="rounded-xl bg-slate-800/50 hover:bg-violet-500/20 border border-white/10 p-4 text-center transition-all group">
                <div class="text-2xl mb-2 text-violet-400 group-hover:scale-110 transition-transform"><i class="fas fa-shopping-cart"></i></div>
                <p class="text-sm text-slate-300 group-hover:text-white transition-colors">Pesanan</p>
            </a>
            <a href="{{ route('admin.users.index') }}" class="rounded-xl bg-slate-800/50 hover:bg-emerald-500/20 border border-white/10 p-4 text-center transition-all group">
                <div class="text-2xl mb-2 text-emerald-400 group-hover:scale-110 transition-transform"><i class="fas fa-users"></i></div>
                <p class="text-sm text-slate-300 group-hover:text-white transition-colors">Kelola User</p>
            </a>
            <a href="{{ route('admin.reports') }}" class="rounded-xl bg-slate-800/50 hover:bg-violet-500/20 border border-white/10 p-4 text-center transition-all group">
                <div class="text-2xl mb-2 text-violet-400 group-hover:scale-110 transition-transform"><i class="fas fa-chart-pie"></i></div>
                <p class="text-sm text-slate-300 group-hover:text-white transition-colors">Laporan</p>
            </a>
        </div>
    </div>
</div>
@endsection
