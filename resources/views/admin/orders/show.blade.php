@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Detail Transaksi</h1>
            <p class="text-slate-400">Lihat informasi lengkap pesanan dan pelanggan.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="rounded-full bg-slate-800/80 px-5 py-3 text-slate-200 font-semibold hover:bg-slate-700 transition-all">Kembali ke Transaksi</a>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <p class="text-slate-400 text-sm">Invoice</p>
                    <p class="text-white font-semibold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Status</p>
                    <span class="inline-flex rounded-full bg-indigo-500/10 px-4 py-2 text-sm font-semibold text-indigo-200">{{ $order->status }}</span>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Pelanggan</p>
                    <p class="text-white font-semibold">{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Tanggal</p>
                    <p class="text-white font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-8 space-y-4">
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

        <div class="rounded-[2rem] bg-gradient-to-br from-indigo-500/10 via-slate-900/90 to-slate-950/80 border border-white/10 p-8 shadow-xl">
            <h2 class="text-xl font-semibold text-white">Ringkasan Pembayaran</h2>
            <div class="mt-6 space-y-4 rounded-3xl bg-slate-950/90 p-6 border border-white/10">
                <div class="flex items-center justify-between text-slate-400">Subtotal</div>
                <div class="text-2xl font-semibold text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                <div class="flex items-center justify-between text-slate-400">Metode Pembayaran</div>
                <div class="text-white">{{ $order->payment_method }}</div>
                <div class="flex items-center justify-between text-slate-400">Penerima</div>
                <div class="text-white">{{ $order->recipient_name }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
