@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('admin.barangs.index') }}" class="inline-flex items-center gap-2 text-sky-400 hover:text-sky-300 transition-colors mb-4">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data Barang
        </a>
        <h1 class="text-3xl font-bold text-white">Edit Barang</h1>
        <p class="text-slate-400 mt-2">Perbarui informasi barang yang ada dalam sistem</p>
    </div>

    <!-- Form Card -->
    <div class="rounded-2xl glass border border-white/10 p-8 shadow-xl">
        <form id="barangForm" action="{{ route('admin.barangs.update', $barang) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Barang Field -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-300 mb-3">
                    <i class="fas fa-box-open text-indigo-400 mr-2"></i>
                    Nama Barang
                </label>
                <div class="relative">
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama', $barang->nama) }}"
                        placeholder="Contoh: Beras Premium 5kg"
                        required
                        class="w-full px-5 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                    />
                </div>
                @error('nama')
                    <p class="text-rose-400 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Harga Barang Field -->
            <div>
                <label for="harga" class="block text-sm font-semibold text-slate-300 mb-3">
                    <i class="fas fa-money-bill-wave text-emerald-400 mr-2"></i>
                    Harga Barang (Rp)
                </label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400">Rp</span>
                    <input
                        type="number"
                        id="harga"
                        name="harga"
                        min="0"
                        value="{{ old('harga', $barang->harga) }}"
                        placeholder="0"
                        required
                        class="w-full pl-12 pr-5 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                    />
                </div>
                @error('harga')
                    <p class="text-rose-400 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Stok Barang Field -->
            <div>
                <label for="stok" class="block text-sm font-semibold text-slate-300 mb-3">
                    <i class="fas fa-cubes text-sky-400 mr-2"></i>
                    Stok Barang
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        min="0"
                        value="{{ old('stok', $barang->stok ?? 0) }}"
                        placeholder="0"
                        required
                        class="w-full px-5 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-sky-500/50 focus:ring-2 focus:ring-sky-500/20 transition-all"
                    />
                </div>
                @error('stok')
                    <p class="text-rose-400 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Gambar Barang Field -->
            <div>
                <label for="gambar" class="block text-sm font-semibold text-slate-300 mb-3">
                    <i class="fas fa-image text-purple-400 mr-2"></i>
                    Gambar Barang (Opsional)
                </label>
                @if($barang->gambar)
                    <div class="mb-4">
                        <p class="text-slate-400 text-sm mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('images/barangs/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="w-32 h-32 object-cover rounded-lg border border-white/10">
                    </div>
                @endif
                <div class="relative">
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        class="w-full px-5 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-500/20 file:text-purple-300 hover:file:bg-purple-500/30"
                    />
                </div>
                <p class="text-slate-500 text-xs mt-2">Format: JPG, PNG, GIF, SVG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
                @error('gambar')
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
                    <i class="fas fa-save"></i>
                    Perbarui Barang
                </button>
                <a
                    href="{{ route('admin.barangs.index') }}"
                    class="flex-1 px-6 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-slate-300 hover:bg-slate-800 font-semibold transition-all flex items-center justify-center gap-2"
                >
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 rounded-2xl glass border border-white/10 p-6 shadow-lg">
        <div class="flex gap-4">
            <div class="w-12 h-12 rounded-lg bg-sky-500/20 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-lightbulb text-sky-400 text-lg"></i>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-2">Informasi</h3>
                <ul class="space-y-2 text-slate-400 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-sky-400 rounded-full"></span>
                        Perubahan akan disimpan secara otomatis saat Anda klik tombol "Perbarui"
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-sky-400 rounded-full"></span>
                        Harga barang tidak boleh negatif
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-sky-400 rounded-full"></span>
                        Hubungi admin jika ada kesalahan data
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Configure Toastr
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "slideUp"
};

// Form submission handler
document.getElementById('barangForm').addEventListener('submit', function(e) {
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui...';
    
    // Store original state
    submitBtn.dataset.originalText = originalText;
    submitBtn.dataset.originalDisabled = false;
});

// Show error messages if validation fails
document.addEventListener('DOMContentLoaded', function() {
    // Check if there are validation errors
    const errorMessages = document.querySelectorAll('.text-rose-400');
    if (errorMessages.length > 0) {
        toastr.error('Mohon periksa kembali formulir Anda', 'Validasi Gagal', {
            closeButton: true,
            progressBar: true,
            timeOut: 5000
        });
        
        // Reset submit button if it's disabled
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = submitBtn.dataset.originalText || '<i class="fas fa-save"></i> Perbarui Barang';
        }
    }
});
</script>
@endsection
