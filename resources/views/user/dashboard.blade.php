@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
<div class="space-y-8">
    <section class="rounded-[2rem] bg-gradient-to-br from-slate-900 via-slate-900 to-indigo-950 border border-white/10 p-8 shadow-2xl shadow-indigo-950/20 overflow-hidden">
        <div class="grid lg:grid-cols-[1.2fr_0.8fr] gap-8 items-center">
            <div class="space-y-6">
                <span class="inline-flex items-center rounded-full bg-indigo-500/10 px-4 py-2 text-sm font-semibold text-indigo-200">Selamat Datang di Toko Bahan Makanan</span>
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">Belanja Bahan Masakan dengan Cepat, Aman, dan Elegan</h1>
                <p class="max-w-2xl text-slate-400 text-lg">Temukan produk terbaik dengan kategori modern. Kelola pesanan, lihat riwayat, dan nikmati pengalaman belanja yang profesional di aplikasi kami.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 rounded-3xl bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-3 text-white font-semibold shadow-xl hover:scale-[1.02] transition-transform">Telusuri Produk <i class="fas fa-arrow-right"></i></a>
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-3 rounded-3xl border border-white/10 px-6 py-3 text-slate-200 hover:bg-slate-800 transition-colors">Lihat Keranjang</a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -left-16 top-10 h-40 w-40 rounded-full bg-gradient-to-br from-violet-500/30 to-sky-500/10 blur-3xl"></div>
                <div class="absolute right-0 bottom-10 h-32 w-32 rounded-full bg-gradient-to-br from-sky-500/20 to-indigo-500/10 blur-3xl"></div>
                <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-6 shadow-2xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-3xl bg-slate-950/70 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Produk Populer</p>
                            <h2 class="mt-4 text-2xl text-white font-semibold">{{ $popular->count() }} Pilihan</h2>
                        </div>
                        <div class="rounded-3xl bg-gradient-to-br from-indigo-500/20 to-sky-500/20 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-slate-300">Produk Terbaru</p>
                            <h2 class="mt-4 text-2xl text-white font-semibold">{{ $featured->count() }} Terbaru</h2>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        @foreach ($popular->take(2) as $barang)
                            <div class="rounded-3xl bg-slate-950/90 p-4 border border-white/10 hover:border-indigo-500/40 transition-all">
                                <p class="text-slate-400 text-sm">{{ $barang->nama }}</p>
                                <p class="mt-3 text-white font-semibold">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white">Rekomendasi Produk</h2>
                <p class="text-slate-400">Pilihan terbaik untuk kebutuhan dapur Anda.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat]) }}" class="rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-slate-300 hover:border-indigo-400 hover:text-white transition-all">{{ $cat }}</a>
                @endforeach
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach($featured as $barang)
                <div class="group rounded-[2rem] bg-slate-900/80 border border-white/10 p-5 shadow-xl hover:-translate-y-1 transition-transform">
                    <div class="flex items-center justify-between mb-5">
                        <span class="rounded-2xl bg-indigo-500/10 px-3 py-1 text-xs font-semibold uppercase text-indigo-300">Baru</span>
                        <span class="text-xs text-slate-500">Stok {{ $barang->stok }}</span>
                    </div>
                    <div class="mb-6 rounded-3xl bg-slate-950/80 p-4 text-center">
                        @if($barang->gambar)
                            <img src="{{ asset('images/barangs/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="mx-auto h-36 w-36 object-cover rounded-3xl">
                        @else
                            <div class="flex h-36 w-36 items-center justify-center rounded-3xl bg-slate-800 text-slate-500">
                                <i class="fas fa-box-open text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-xl font-semibold text-white">{{ $barang->nama }}</h3>
                        <p class="text-slate-400">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                        <p class="text-slate-500 text-sm">Stok tersedia {{ $barang->stok }} unit.</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <form action="{{ route('cart.add', $barang) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:scale-105 transition-transform">
                                <i class="fas fa-shopping-cart"></i> Beli
                            </button>
                        </form>
                        <span class="text-sm text-slate-400">#{{ $barang->id }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-2xl">
        <div class="grid gap-8 lg:grid-cols-2 items-center">
            <div>
                <h2 class="text-3xl font-bold text-white">Belanja lebih mudah dengan pengalaman modern.</h2>
                <p class="mt-4 text-slate-400">Nikmati fitur lengkap: keranjang, checkout, riwayat pesanan, dan profil dengan tampilan yang rapi serta elegan.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-slate-950/80 border border-white/10 p-5">
                    <p class="text-slate-400 text-sm">Sorted Produk</p>
                    <h3 class="mt-3 text-xl text-white font-semibold">Kualitas Terjaga</h3>
                </div>
                <div class="rounded-3xl bg-slate-950/80 border border-white/10 p-5">
                    <p class="text-slate-400 text-sm">Checkout Cepat</p>
                    <h3 class="mt-3 text-xl text-white font-semibold">Pembayaran Aman</h3>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
