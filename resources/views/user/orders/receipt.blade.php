@extends('layouts.app')

@section('title', 'Struk Pembayaran')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-slate-400 text-sm uppercase tracking-[0.2em]">Struk Pembayaran</p>
                <h1 class="text-3xl font-bold text-white">Pembayaran Berhasil</h1>
                <p class="text-slate-500 mt-2">Terima kasih telah berbelanja. Silakan simpan bukti pembayaran ini sebagai referensi.</p>
            </div>
            <div class="rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-5 py-3 text-white shadow-xl">
                <p class="text-sm uppercase tracking-[0.2em]">Invoice</p>
                <p class="text-lg font-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-3">
            <div class="rounded-3xl bg-slate-950/80 border border-white/10 p-6">
                <p class="text-slate-400 text-sm uppercase tracking-[0.2em]">Detail Pembeli</p>
                <p class="mt-3 text-white font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-slate-500 text-sm">{{ auth()->user()->email }}</p>
                <p class="mt-4 text-slate-400 text-xs uppercase tracking-[0.2em]">Metode Pembayaran</p>
                <p class="text-white font-semibold">{{ $order->payment_method }}</p>
            </div>
            <div class="rounded-3xl bg-slate-950/80 border border-white/10 p-6">
                <p class="text-slate-400 text-sm uppercase tracking-[0.2em]">Penerima</p>
                <p class="mt-3 text-white font-semibold">{{ $order->recipient_name }}</p>
                <p class="text-slate-500 text-sm">{{ $order->phone }}</p>
                <p class="mt-4 text-slate-400 text-xs uppercase tracking-[0.2em]">Status Pesanan</p>
                <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-2 text-sm font-semibold text-emerald-200">{{ $order->status }}</span>
            </div>
            <div class="rounded-3xl bg-slate-950/80 border border-white/10 p-6">
                <p class="text-slate-400 text-sm uppercase tracking-[0.2em]">Alamat</p>
                <p class="mt-3 text-white font-semibold">{{ $order->address }}</p>
                <p class="text-slate-500 text-sm mt-4">Tanggal</p>
                <p class="text-white font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-10 rounded-[2rem] bg-slate-950/80 border border-white/10 p-8">
            <h2 class="text-xl font-semibold text-white">Rincian Pesanan</h2>
            <div class="mt-6 space-y-4">
                @foreach($order->details as $detail)
                    <div class="grid gap-4 md:grid-cols-[1.5fr_0.9fr_0.8fr_0.8fr] items-center rounded-3xl bg-slate-900/80 p-4">
                        <div>
                            <p class="text-white font-semibold">{{ $detail->name }}</p>
                            <p class="text-slate-500 text-sm">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-slate-400 text-sm">Harga</p>
                        <p class="text-slate-400 text-sm">Qty</p>
                        <p class="text-emerald-400 text-right font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-8 rounded-[2rem] bg-gradient-to-r from-indigo-500/20 to-sky-500/20 border border-indigo-500/20 p-6">
            <div class="flex items-center justify-between text-slate-400">Subtotal</div>
            <div class="mt-3 flex items-center justify-between text-white font-semibold text-xl">Total</div>
            <div class="mt-3 flex items-center justify-between text-2xl font-bold text-emerald-400">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
        </div>

        <div class="mt-10 flex flex-col gap-4 sm:flex-row">
            <a href="javascript:window.print()" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-4 text-white font-semibold shadow-xl hover:scale-[1.02] transition-transform">
                <i class="fas fa-print"></i> Cetak Struk
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-slate-800/80 border border-white/10 px-6 py-4 text-slate-200 font-semibold hover:bg-slate-700 transition-all">
                <i class="fas fa-home"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
