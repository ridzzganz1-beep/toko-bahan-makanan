@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Daftar Produk</h1>
            <p class="text-slate-400">Temukan berbagai kebutuhan bahan makanan untuk dapur Anda.</p>
        </div>
        <form method="GET" action="{{ route('products.index') }}" class="w-full lg:w-auto">
            <div class="relative rounded-full border border-white/10 bg-slate-900/70 px-4 py-3 flex items-center gap-3">
                <i class="fas fa-search text-slate-500"></i>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk..." class="w-full bg-transparent text-slate-200 placeholder-slate-500 outline-none" />
                <button type="submit" class="rounded-full bg-indigo-500 px-4 py-2 text-white text-sm font-semibold hover:bg-indigo-400 transition-all">Cari</button>
            </div>
        </form>
    </div>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('products.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ empty($category) ? 'bg-indigo-500 text-white' : 'bg-slate-900 text-slate-300' }}">Semua</a>
        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat]) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ $category === $cat ? 'bg-indigo-500 text-white' : 'bg-slate-900 text-slate-300' }}">{{ $cat }}</a>
        @endforeach
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($barangs as $barang)
            <div class="group rounded-[2rem] bg-slate-900/80 border border-white/10 p-5 shadow-xl hover:-translate-y-1 transition-transform">
                <div class="relative overflow-hidden rounded-[1.75rem] bg-slate-950/80 p-5">
                    @if ($barang->gambar)
                        <img src="{{ asset('images/barangs/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="h-56 w-full object-cover rounded-[1.5rem]" />
                    @else
                        <div class="flex h-56 items-center justify-center rounded-[1.5rem] bg-slate-800 text-slate-500">
                            <i class="fas fa-box-open text-4xl"></i>
                        </div>
                    @endif
                </div>
                <div class="mt-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-white">{{ $barang->nama }}</h2>
                        <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-sm text-emerald-300">Stok {{ $barang->stok }}</span>
                    </div>
                    <p class="text-slate-400 text-sm">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                    <div class="flex items-center justify-between gap-3">
                        <form action="{{ route('cart.add', $barang) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-4 py-2 text-sm font-semibold text-white shadow-lg hover:scale-105 transition-transform">
                                <i class="fas fa-cart-plus"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-[2rem] bg-slate-900/80 border border-dashed border-white/10 p-10 text-center">
                <p class="text-slate-400">Belum ada produk yang tersedia.</p>
                <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center gap-2 rounded-full bg-indigo-500 px-5 py-3 text-white font-semibold hover:bg-indigo-400 transition-all">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $barangs->links() }}
    </div>
</div>
@endsection
