@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-gradient-to-r from-indigo-600 to-sky-600 p-8 shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Laporan Penjualan</h2>
                <p class="text-indigo-100">Ringkasan laporan untuk produk, transaksi, dan pelanggan.</p>
            </div>
            <div class="inline-flex items-center gap-3 rounded-full bg-white/10 px-5 py-3 text-slate-100">
                <i class="fas fa-chart-line text-xl text-indigo-200"></i>
                <span class="text-sm">Data diambil secara real-time untuk analisis cepat.</span>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-[2rem] glass border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400 text-sm font-medium mb-2">Total Produk</p>
            <p class="text-4xl font-bold text-white">{{ $barangCount }}</p>
            <p class="text-slate-500 text-sm mt-3">Jumlah produk tersedia dalam inventaris.</p>
        </div>
        <div class="rounded-[2rem] glass border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400 text-sm font-medium mb-2">Total Pesanan</p>
            <p class="text-4xl font-bold text-white">{{ $orderCount }}</p>
            <p class="text-slate-500 text-sm mt-3">Pesanan yang masuk hingga saat ini.</p>
        </div>
        <div class="rounded-[2rem] glass border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400 text-sm font-medium mb-2">Total Pelanggan</p>
            <p class="text-4xl font-bold text-white">{{ $userCount }}</p>
            <p class="text-slate-500 text-sm mt-3">Pengguna terdaftar yang dapat melakukan pembelian.</p>
        </div>
    </div>

    <div class="rounded-[2rem] glass border border-white/10 p-6 shadow-xl">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-white">Laporan Ringkas</h3>
                <p class="text-slate-400">Lihat performa penjualan, user, dan stok produk dalam satu tampilan.</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 rounded-3xl bg-indigo-500 px-5 py-3 text-white font-semibold hover:bg-indigo-400 transition-all">
                <i class="fas fa-receipt"></i>
                Lihat Pesanan Lengkap
            </a>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-2">
            <div class="rounded-[2rem] bg-slate-950/80 p-5 border border-white/10">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-slate-300 font-semibold">Inventaris Produk</p>
                    <span class="text-slate-500 text-sm">Updated now</span>
                </div>
                <div class="mt-5 text-white text-3xl font-bold">{{ $barangCount }}</div>
                <p class="mt-3 text-slate-400">Anda dapat mengelola stok dan menambah produk baru di menu Data Barang.</p>
            </div>
            <div class="rounded-[2rem] bg-slate-950/80 p-5 border border-white/10">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-slate-300 font-semibold">Transaksi Aktif</p>
                    <span class="text-slate-500 text-sm">Updated now</span>
                </div>
                <div class="mt-5 text-white text-3xl font-bold">{{ $orderCount }}</div>
                <p class="mt-3 text-slate-400">Kelola status dan cetak struk untuk transaksi selesai.</p>
            </div>
        </div>
    </div>
</div>
@endsection
