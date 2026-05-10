@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Semua Transaksi</h1>
            <p class="text-slate-400">Lihat pesanan pelanggan dan status pembayaran.</p>
        </div>
    </div>

    <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 shadow-xl overflow-x-auto">
        <table class="min-w-full text-left text-slate-300">
            <thead class="bg-slate-950/90 text-sm uppercase tracking-[0.2em] text-slate-500 border-b border-white/10">
                <tr>
                    <th class="px-6 py-4">Invoice</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($orders as $order)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm font-semibold text-indigo-200">{{ $order->status }}</span></td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="rounded-full bg-slate-800/70 px-4 py-2 text-sm font-semibold text-slate-200 hover:bg-slate-700 transition-all">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
