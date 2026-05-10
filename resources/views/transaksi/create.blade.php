@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sky-400 hover:text-sky-300 transition-colors mb-4">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
        <h1 class="text-3xl font-bold text-white">Buat Transaksi Pembelian</h1>
        <p class="text-slate-400 mt-2">Isi informasi pembeli, pilih barang, dan tentukan jumlah pembelian</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Card -->
        <div class="lg:col-span-2">
            <div class="rounded-2xl glass border border-white/10 p-8 shadow-xl">
                <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm" class="space-y-6">
                    @csrf

                    <!-- Nama Pembeli Field -->
                    <div>
                        <label for="pembeli" class="block text-sm font-semibold text-slate-300 mb-3">
                            <i class="fas fa-user text-indigo-400 mr-2"></i>
                            Nama Pembeli
                        </label>
                        <input
                            type="text"
                            id="pembeli"
                            name="pembeli"
                            value="{{ old('pembeli') }}"
                            placeholder="Masukkan nama pembeli"
                            required
                            class="w-full px-5 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        />
                        @error('pembeli')
                            <p class="text-rose-400 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Barang Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-4">
                            <i class="fas fa-boxes text-emerald-400 mr-2"></i>
                            Pilih Barang
                        </label>
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @forelse ($barangs as $barang)
                                <div class="rounded-xl bg-slate-800/50 border border-white/10 p-4 hover:border-indigo-500/30 transition-all group">
                                    <div class="flex items-start gap-4">
                                        <input
                                            type="checkbox"
                                            id="barang_{{ $barang->id }}"
                                            name="barangs[]"
                                            value="{{ $barang->id }}"
                                            {{ is_array(old('barangs')) && in_array($barang->id, old('barangs')) ? 'checked' : '' }}
                                            class="mt-1 w-5 h-5 rounded border-white/20 text-indigo-500 focus:ring-indigo-500/20 cursor-pointer"
                                            onchange="calculateTotal()"
                                        />
                                        <div class="flex-1">
                                            <label for="barang_{{ $barang->id }}" class="flex items-start justify-between cursor-pointer">
                                                <div class="flex-1">
                                                    <h4 class="text-white font-semibold group-hover:text-indigo-300 transition-colors">{{ $barang->nama }}</h4>
                                                    <p class="text-slate-400 text-sm mt-1">
                                                        Harga: <span class="text-emerald-400 font-semibold">Rp {{ number_format($barang->harga, 0, ',', '.') }}</span>
                                                    </p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <label for="jumlah_{{ $barang->id }}" class="text-slate-400 text-sm">Qty:</label>
                                            <input
                                                type="number"
                                                id="jumlah_{{ $barang->id }}"
                                                name="jumlah[{{ $barang->id }}]"
                                                min="1"
                                                value="{{ old('jumlah.' . $barang->id, 1) }}"
                                                class="w-16 px-3 py-2 rounded-lg bg-slate-700 border border-white/10 text-white text-sm focus:outline-none focus:border-emerald-500/50 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                                                onchange="calculateTotal()"
                                                onkeyup="calculateTotal()"
                                            />
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-inbox text-4xl text-slate-600 mb-3"></i>
                                    <p class="text-slate-400">Tidak ada barang tersedia</p>
                                    <a href="{{ route('admin.barangs.create') }}" class="mt-3 inline-block text-indigo-400 hover:text-indigo-300 transition-colors text-sm font-semibold">
                                        <i class="fas fa-plus"></i> Tambah Barang Terlebih Dahulu
                                    </a>
                                </div>
                            @endforelse
                        </div>
                        @error('barangs')
                            <p class="text-rose-400 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-6 border-t border-white/10">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-sky-500 text-white font-semibold hover:shadow-lg hover:scale-105 transition-all flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-check-circle"></i>
                            Proses Transaksi
                        </button>
                        <a
                            href="{{ route('dashboard') }}"
                            class="flex-1 px-6 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-slate-300 hover:bg-slate-800 font-semibold transition-all flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="lg:col-span-1">
            <div class="rounded-2xl glass border border-white/10 p-6 shadow-xl sticky top-24">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-receipt text-yellow-400"></i>
                    Ringkasan
                </h3>
                <div class="space-y-4">
                    <div class="rounded-xl bg-slate-800/50 p-4 border border-white/10">
                        <p class="text-slate-400 text-sm mb-1">Total Item</p>
                        <p id="totalItems" class="text-3xl font-bold text-indigo-400">0</p>
                    </div>
                    <div class="rounded-xl bg-slate-800/50 p-4 border border-white/10">
                        <p class="text-slate-400 text-sm mb-1">Total Harga</p>
                        <p id="totalPrice" class="text-2xl font-bold text-emerald-400">Rp 0</p>
                    </div>
                    <div class="rounded-xl bg-gradient-to-r from-indigo-500/20 to-sky-500/20 border border-indigo-500/20 p-4">
                        <p class="text-slate-300 text-xs font-semibold text-center">Klik "Proses Transaksi" untuk melanjutkan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const barangData = {
        @foreach ($barangs as $barang)
            {{ $barang->id }}: {{ $barang->harga }},
        @endforeach
    };

    function calculateTotal() {
        let totalItems = 0;
        let totalPrice = 0;
        
        for (let barangId in barangData) {
            const checkbox = document.getElementById(`barang_${barangId}`);
            const jumlahInput = document.getElementById(`jumlah_${barangId}`);
            
            if (checkbox && checkbox.checked) {
                const jumlah = parseInt(jumlahInput.value) || 1;
                totalItems += jumlah;
                totalPrice += barangData[barangId] * jumlah;
            }
        }
        
        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('totalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    calculateTotal();
</script>
@endsection
