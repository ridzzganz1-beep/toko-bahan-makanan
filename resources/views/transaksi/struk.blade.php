@extends('layouts.app')

@section('title', 'Struk Transaksi')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sky-400 hover:text-sky-300 transition-colors">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

    <!-- Struk Card -->
    <div class="rounded-2xl glass border border-white/10 p-8 shadow-xl">
        <!-- Header -->
        <div class="text-center mb-8 pb-8 border-b-2 border-dashed border-white/20">
            <div class="inline-block w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-sky-500 flex items-center justify-center text-white text-3xl mb-4 shadow-lg">
                <i class="fas fa-receipt"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-1">TOKO BAHAN MAKANAN</h1>
            <p class="text-slate-400 text-sm">Struk Pembelian</p>
            <p class="text-slate-500 text-xs mt-2">Invoice #{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>

        <!-- Customer Info -->
        <div class="mb-8 grid grid-cols-2 gap-6">
            <div>
                <p class="text-slate-400 text-xs font-semibold uppercase mb-1">Pembeli</p>
                <p class="text-white font-semibold text-lg">{{ $transaksi->pembeli }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-400 text-xs font-semibold uppercase mb-1">Tanggal & Waktu</p>
                <p class="text-white font-semibold">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="mb-8">
            <table class="w-full">
                <thead class="border-b-2 border-white/10">
                    <tr>
                        <th class="text-left text-slate-300 font-semibold text-sm py-3">ITEM</th>
                        <th class="text-right text-slate-300 font-semibold text-sm py-3">HARGA</th>
                        <th class="text-right text-slate-300 font-semibold text-sm py-3">QTY</th>
                        <th class="text-right text-slate-300 font-semibold text-sm py-3">TOTAL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @php
                        $items = is_string($transaksi->items) ? json_decode($transaksi->items, true) : $transaksi->items;
                        $items = is_array($items) ? $items : [];
                    @endphp
                    @forelse ($items as $item)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="py-3">
                                <p class="text-white font-medium">{{ $item['nama'] ?? 'Unknown' }}</p>
                            </td>
                            <td class="text-right py-3">
                                <p class="text-emerald-400 font-semibold">Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }}</p>
                            </td>
                            <td class="text-right py-3">
                                <p class="text-slate-300">{{ $item['jumlah'] ?? 0 }} x</p>
                            </td>
                            <td class="text-right py-3">
                                <p class="text-sky-400 font-bold">Rp {{ number_format(($item['harga'] ?? 0) * ($item['jumlah'] ?? 0), 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-400">Tidak ada item</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="bg-gradient-to-r from-indigo-500/20 to-sky-500/20 border border-indigo-500/20 rounded-xl p-6 mb-8">
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-slate-300">Subtotal</span>
                    <span class="text-white font-semibold">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-300">Pajak (0%)</span>
                    <span class="text-white font-semibold">Rp 0</span>
                </div>
                <div class="border-t border-white/10 pt-3 flex justify-between items-center">
                    <span class="text-lg font-bold text-white">TOTAL</span>
                    <span class="text-2xl font-bold text-emerald-400">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center py-6 border-t-2 border-dashed border-white/20">
            <p class="text-slate-400 text-sm mb-4">Terima kasih telah berbelanja!</p>
            <p class="text-slate-500 text-xs">Simpan struk ini untuk referensi</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 flex-col sm:flex-row">
        <a href="javascript:window.print()" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-sky-500 text-white font-semibold hover:shadow-lg hover:scale-105 transition-all">
            <i class="fas fa-print"></i>
            Cetak Struk
        </a>
        <a href="{{ route('transaksi.create') }}" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-slate-300 hover:bg-slate-800 font-semibold transition-all">
            <i class="fas fa-plus"></i>
            Transaksi Baru
        </a>
        <a href="{{ route('dashboard') }}" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-slate-300 hover:bg-slate-800 font-semibold transition-all">
            <i class="fas fa-home"></i>
            Dashboard
        </a>
    </div>
</div>

<script>
    // Auto-focus print dialog on load
    window.addEventListener('load', function() {
        // Uncomment to auto-open print dialog
        // window.print();
    });
</script>
@endsection
