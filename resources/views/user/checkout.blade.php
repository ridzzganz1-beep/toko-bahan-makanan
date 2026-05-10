@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Checkout</h1>
            <p class="text-slate-400">Isi informasi penerima dan selesaikan pesanan Anda.</p>
        </div>
        <div class="rounded-full bg-slate-900/80 px-5 py-3 text-slate-300">Total Pesanan: <span class="font-semibold text-white">Rp {{ number_format($cart->items->sum(fn($item)=>$item->subtotal), 0, ',', '.') }}</span></div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.6fr_1fr]">
        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Nama Penerima</label>
                        <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Nomor HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Alamat</label>
                    <textarea name="address" rows="4" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20">{{ old('address') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">Metode Pembayaran</label>
                    <select name="payment_method" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Transfer Bank" {{ old('payment_method') === 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="COD" {{ old('payment_method') === 'COD' ? 'selected' : '' }}>COD</option>
                        <option value="Dana" {{ old('payment_method') === 'Dana' ? 'selected' : '' }}>Dana</option>
                        <option value="OVO" {{ old('payment_method') === 'OVO' ? 'selected' : '' }}>OVO</option>
                        <option value="Gopay" {{ old('payment_method') === 'Gopay' ? 'selected' : '' }}>Gopay</option>
                    </select>
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center gap-3 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-4 text-white text-base font-semibold shadow-xl hover:scale-[1.02] transition-transform">
                    <i class="fas fa-credit-card"></i>
                    Bayar Sekarang
                </button>
            </form>
        </div>

        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
            <div class="rounded-[1.75rem] bg-slate-950/80 p-6">
                <h2 class="text-xl font-semibold text-white">Ringkasan Pesanan</h2>
                <div class="mt-6 space-y-4">
                    @foreach($cart->items as $item)
                        <div class="flex items-center justify-between gap-4 rounded-3xl bg-slate-900/80 p-4">
                            <div>
                                <p class="text-white font-semibold">{{ $item->name }}</p>
                                <p class="text-slate-500 text-sm">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-emerald-400 font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 rounded-3xl bg-indigo-500/10 p-5 border border-indigo-500/20">
                    <div class="flex items-center justify-between text-slate-300">Total Barang</div>
                    <div class="mt-3 text-3xl font-bold text-white">Rp {{ number_format($cart->items->sum(fn($item)=>$item->subtotal), 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
