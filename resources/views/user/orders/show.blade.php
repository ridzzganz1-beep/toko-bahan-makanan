@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Detail Pesanan</h1>
            <p class="text-slate-400">Informasi lengkap pesanan dan ringkasan pembayaran.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="rounded-full bg-slate-800/80 px-5 py-3 text-slate-200 font-semibold hover:bg-slate-700 transition-all">Kembali ke Riwayat</a>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.4fr_0.8fr]">
        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <p class="text-slate-400 text-sm">Nomor Pesanan</p>
                    <p class="text-white font-semibold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Status</p>
                    <span class="inline-flex rounded-full bg-indigo-500/15 px-4 py-2 text-sm font-semibold text-indigo-200">{{ $order->status }}</span>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Tanggal</p>
                    <p class="text-white font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Metode Pembayaran</p>
                    <p class="text-white font-semibold">{{ $order->payment_method }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold text-white">Daftar Barang</h2>
                <div class="mt-4 space-y-4">
                    @foreach($order->details as $detail)
                        <div class="rounded-3xl bg-slate-950/90 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-white font-semibold">{{ $detail->name }}</p>
                                    <p class="text-slate-500 text-sm">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="text-emerald-400 font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
            <h2 class="text-xl font-semibold text-white">Ringkasan Pembayaran</h2>
            <div class="mt-6 space-y-4">
                <div class="flex items-center justify-between text-slate-400">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-slate-400">
                    <span>Pajak</span>
                    <span>Rp 0</span>
                </div>
                <div class="border-t border-white/10 pt-4 flex items-center justify-between text-white font-semibold">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-8 space-y-4 bg-slate-950/80 rounded-[1.75rem] p-6 border border-white/10">
                <p class="text-slate-400 text-sm">Penerima</p>
                <p class="text-white font-semibold">{{ $order->recipient_name }}</p>
                <p class="text-slate-400 text-sm">Nomor HP</p>
                <p class="text-white font-semibold">{{ $order->phone }}</p>
                <p class="text-slate-400 text-sm">Alamat</p>
                <p class="text-white font-semibold">{{ $order->address }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
