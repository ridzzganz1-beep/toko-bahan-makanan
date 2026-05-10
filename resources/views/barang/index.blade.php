@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 animate-fadeIn">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Data Barang</h1>
            <p class="text-slate-400">Kelola semua data barang toko Anda dengan mudah</p>
        </div>
        <a href="{{ route('admin.barangs.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-sky-500 text-white font-semibold hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
            <i class="fas fa-plus"></i>
            Tambah Barang Baru
        </a>
    </div>

    <!-- Search Bar -->
    <div class="glass border border-white/10 rounded-xl p-4 animate-fadeIn">
        <div class="flex items-center gap-2 bg-slate-800/50 rounded-lg px-4 py-3 border border-white/10 hover:border-indigo-500/30 transition-all">
            <i class="fas fa-search text-slate-400"></i>
            <input type="text" id="searchInput" placeholder="Cari barang berdasarkan nama..." class="w-full bg-transparent text-slate-300 placeholder-slate-500 outline-none text-sm" onkeyup="filterTable()">
        </div>
    </div>

    <!-- Barang Table -->
    <div class="rounded-2xl glass border border-white/10 overflow-hidden shadow-2xl animate-fadeIn" style="animation-delay: 0.1s;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b-2 border-indigo-500/20 bg-gradient-to-r from-indigo-500/10 to-sky-500/10">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-indigo-400">#</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-indigo-400">Gambar</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-indigo-400">Nama Barang</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-indigo-400">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-indigo-400">Dibuat</th>
                        <th class="px-6 py-4 text-right text-sm font-bold text-indigo-400">Aksi</th>
                    </tr>
                </thead>
                <tbody id="barangTableBody" class="divide-y divide-white/5">
                    @forelse ($barangs as $barang)
                        <tr class="barang-row hover:bg-white/5 transition-all duration-300 border-l-4 border-transparent hover:border-indigo-500" data-nama="{{ strtolower($barang->nama) }}">
                            <td class="px-6 py-4 text-slate-300 font-semibold">{{ $barangs->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4">
                                @if($barang->gambar)
                                    <img src="{{ asset('images/barangs/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="w-16 h-16 object-cover rounded-lg border border-white/10 hover:scale-110 transition-transform">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-slate-700/50 border border-white/10 flex items-center justify-center">
                                        <i class="fas fa-image text-slate-500 text-xl"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500/30 to-sky-500/30 flex items-center justify-center border border-indigo-400/20">
                                        <i class="fas fa-box text-indigo-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-semibold">{{ $barang->nama }}</p>
                                        <p class="text-xs text-slate-500">ID: #{{ $barang->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/20 text-emerald-300 text-sm font-bold border border-emerald-500/30 hover:bg-emerald-500/30 transition-all">
                                    <i class="fas fa-money-bill-wave text-xs"></i>
                                    Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-400 text-sm font-medium">{{ $barang->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.barangs.edit', $barang) }}" class="px-4 py-2 rounded-lg bg-sky-500/20 hover:bg-sky-500/30 text-sky-400 hover:text-sky-300 text-sm font-semibold transition-all duration-300 hover:scale-110 inline-flex items-center gap-2 border border-sky-500/20 hover:border-sky-500/50" title="Edit barang">
                                        <i class="fas fa-edit text-sm"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="px-4 py-2 rounded-lg bg-rose-500/20 hover:bg-rose-500/30 text-rose-400 hover:text-rose-300 text-sm font-semibold transition-all duration-300 hover:scale-110 inline-flex items-center gap-2 border border-rose-500/20 hover:border-rose-500/50" onclick="deleteBarang({{ $barang->id }}, '{{ addslashes($barang->nama) }}')" title="Hapus barang">
                                        <i class="fas fa-trash text-sm"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-24 h-24 rounded-full bg-slate-800/50 border-2 border-dashed border-slate-700 flex items-center justify-center mb-4">
                                        <i class="fas fa-inbox text-4xl text-slate-600"></i>
                                    </div>
                                    <p class="text-slate-400 font-bold text-lg mb-2">Belum ada data barang</p>
                                    <p class="text-slate-500 text-sm mb-6">Mulai dengan menambahkan barang baru untuk toko Anda</p>
                                    <a href="{{ route('admin.barangs.create') }}" class="px-6 py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-sky-500 hover:from-indigo-600 hover:to-sky-600 text-white font-semibold transition-all duration-300 hover:scale-105 inline-flex items-center gap-2">
                                        <i class="fas fa-plus"></i> Tambah Barang Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($barangs->hasPages())
        <div class="flex justify-center items-center gap-2 animate-fadeIn">
            <style>
                .pagination { display: flex; gap: 0.5rem; justify-content: center; }
                .pagination a, .pagination span { 
                    padding: 0.5rem 0.75rem; 
                    border-radius: 0.5rem; 
                    border: 1px solid rgba(255,255,255,0.1); 
                    color: #cbd5e1; 
                    text-decoration: none; 
                    transition: all 0.3s;
                }
                .pagination a:hover { 
                    background: rgba(99, 102, 241, 0.2); 
                    border-color: rgba(99, 102, 241, 0.5); 
                    color: #a5b4fc;
                }
                .pagination .active span {
                    background: linear-gradient(to right, #6366f1, #0ea5e9);
                    color: white;
                    border-color: #6366f1;
                }
                .pagination .disabled span {
                    opacity: 0.5;
                    cursor: not-allowed;
                }
            </style>
            {{ $barangs->links() }}
        </div>
    @endif
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" action="" style="display: none;">
    @csrf
    @method('DELETE')
</form>

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

// Delete Barang Function
function deleteBarang(id, nama) {
    Swal.fire({
        title: 'Hapus Barang?',
        html: '<p class="text-gray-700">Apakah Anda yakin ingin menghapus barang <strong>' + nama + '</strong>?</p><p class="text-sm text-gray-500 mt-2">Tindakan ini tidak dapat dibatalkan.</p>',
        icon: 'warning',
        iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.showLoading();
            
            // Submit the delete form
            const form = document.getElementById('deleteForm');
            form.action = '/barangs/' + id;
            form.submit();
            
            // Show success message after a short delay
            setTimeout(() => {
                toastr.success('Barang "' + nama + '" berhasil dihapus!', 'Berhasil', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 4000
                });
            }, 500);
        }
    });
}

// Search Filter Function
function filterTable() {
    const searchInput = document.getElementById('searchInput');
    const filter = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('.barang-row');
    
    rows.forEach(row => {
        const nama = row.getAttribute('data-nama');
        if (nama.includes(filter)) {
            row.style.display = '';
            row.classList.add('animate-fadeIn');
        } else {
            row.style.display = 'none';
        }
    });
}

// Show success/error messages
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = '{{ session("success") }}';
    const errorMessage = '{{ session("error") }}';
    
    if (successMessage) {
        toastr.success(successMessage, 'Berhasil', {
            closeButton: true,
            progressBar: true,
            timeOut: 4000
        });
    }
    
    if (errorMessage) {
        toastr.error(errorMessage, 'Gagal', {
            closeButton: true,
            progressBar: true,
            timeOut: 4000
        });
    }
});

// Animate table rows on load
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.barang-row');
    rows.forEach((row, index) => {
        row.style.animation = 'fadeIn 0.3s ease-out ' + (index * 0.05) + 's forwards';
        row.style.opacity = '0';
    });
});
</script>
@endsection
