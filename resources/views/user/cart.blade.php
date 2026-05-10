@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Keranjang Saya</h1>
            <p class="text-slate-400">Tinjau barang pilihan dan lanjutkan ke checkout.</p>
        </div>
        <a href="{{ route('checkout.index') }}" class="rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-3 text-white font-semibold shadow-lg hover:scale-105 transition-transform">Checkout Sekarang</a>
    </div>

    @if(!$cart || $cart->items->isEmpty())
        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-10 text-center">
            <i class="fas fa-shopping-basket text-4xl text-slate-500"></i>
            <h2 class="mt-4 text-2xl font-semibold text-white">Keranjang kosong</h2>
            <p class="mt-2 text-slate-400">Tambahkan barang dari katalog untuk memulai belanja.</p>
            <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-full bg-indigo-500 px-6 py-3 text-white font-semibold hover:bg-indigo-400 transition-all">
                <i class="fas fa-shopping-cart"></i>
                Telusuri Produk
            </a>
        </div>
    @else
        <div class="grid gap-6 xl:grid-cols-[1.6fr_0.95fr]">
            <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-6 shadow-xl">
                <div class="overflow-hidden rounded-[2rem] border border-white/10">
                    <table class="w-full text-left">
                        <thead class="bg-slate-950/90 text-slate-400 text-sm uppercase tracking-[0.15em]">
                            <tr>
                                <th class="px-6 py-4">Produk</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4">Jumlah</th>
                                <th class="px-6 py-4">Subtotal</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($cart->items as $item)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="h-16 w-16 rounded-3xl bg-slate-800/80 flex items-center justify-center text-slate-500">
                                                <i class="fas fa-box text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold">{{ $item->name }}</p>
                                                <p class="text-slate-500 text-sm">ID #{{ $item->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-slate-300">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-5">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 rounded-2xl border border-white/10 bg-slate-950/70 px-3 py-2 text-slate-100 outline-none" />
                                            <button type="submit" class="rounded-2xl bg-slate-800/80 px-4 py-2 text-slate-100 hover:bg-slate-700 transition-all">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-5 text-emerald-300 font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-5">
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-2xl bg-rose-500/20 px-4 py-2 text-rose-200 hover:bg-rose-500/30 transition-all">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-6 shadow-xl sticky top-6 h-fit">
                <h2 class="text-xl font-semibold text-white">Ringkasan Pembayaran</h2>
                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-950/70 p-5">
                        <div class="flex items-center justify-between text-slate-400">Subtotal</div>
                        <div class="mt-3 text-3xl font-bold text-white">Rp {{ number_format($cart->items->sum(fn($item)=>$item->subtotal), 0, ',', '.') }}</div>
                    </div>
                    <div class="rounded-3xl bg-slate-950/70 p-5">
                        <div class="flex items-center justify-between text-slate-400">Estimasi Pajak</div>
                        <div class="mt-3 text-lg font-semibold text-white">Rp 0</div>
                    </div>
                    <div class="rounded-3xl bg-indigo-500/10 p-5 border border-indigo-500/20">
                        <div class="flex items-center justify-between text-slate-300">Total</div>
                        <div class="mt-3 text-3xl font-bold text-white">Rp {{ number_format($cart->items->sum(fn($item)=>$item->subtotal), 0, ',', '.') }}</div>
                    </div>
                </div>
                <a href="{{ route('checkout.index') }}" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-3 text-white font-semibold shadow-lg hover:scale-[1.02] transition-transform">
                    <i class="fas fa-credit-card"></i>
                    Lanjutkan ke Checkout
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
