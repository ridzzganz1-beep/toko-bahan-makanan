@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Riwayat Pembelian</h1>
            <p class="text-slate-400">Lihat detail semua pesanan yang sudah Anda buat.</p>
        </div>
        <a href="{{ route('products.index') }}" class="rounded-full bg-indigo-500 px-5 py-3 text-white font-semibold shadow-lg hover:bg-indigo-400 transition-all">Belanja Lagi</a>
    </div>

    <div class="grid gap-6">
        @forelse($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-6 shadow-xl hover:border-indigo-500/30 transition-all">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-slate-400 text-sm">Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        <h2 class="text-xl font-semibold text-white">{{ $order->recipient_name }}</h2>
                        <p class="text-slate-500 mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="space-y-2 text-right">
                        <span class="inline-flex rounded-full bg-slate-800/70 px-4 py-2 text-sm font-semibold text-slate-200">{{ $order->status }}</span>
                        <p class="text-white font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="rounded-[2rem] bg-slate-900/80 border border-dashed border-white/10 p-10 text-center">
                <i class="fas fa-box-open text-4xl text-slate-500"></i>
                <h2 class="mt-4 text-2xl font-semibold text-white">Belum ada riwayat pembelian</h2>
                <p class="mt-2 text-slate-400">Mulai berbelanja dan pesanan Anda akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
