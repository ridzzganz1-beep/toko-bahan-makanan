@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
    <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-indigo-500 to-sky-500 text-white text-3xl font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <h1 class="text-3xl font-bold text-white">Profil Saya</h1>
                <p class="text-slate-400">Lihat dan perbarui informasi akun Anda.</p>
            </div>
        </div>

        <div class="space-y-8">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6 rounded-[1.75rem] bg-slate-950/80 border border-white/10 p-6">
                @csrf
                @method('PUT')
                <h2 class="text-xl font-semibold text-white">Informasi Akun</h2>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Nama</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                </div>
                <button type="submit" class="rounded-full bg-indigo-500 px-6 py-3 text-white font-semibold shadow-lg hover:bg-indigo-400 transition-all">Simpan Profil</button>
            </form>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-6 rounded-[1.75rem] bg-slate-950/80 border border-white/10 p-6">
                @csrf
                @method('PUT')
                <h2 class="text-xl font-semibold text-white">Ubah Password</h2>
                <div class="grid gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Password Baru</label>
                        <input type="password" name="password" required class="w-full rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
                    </div>
                </div>
                <button type="submit" class="rounded-full bg-emerald-500 px-6 py-3 text-white font-semibold shadow-lg hover:bg-emerald-400 transition-all">Perbarui Password</button>
            </form>
        </div>
    </div>

    <div class="rounded-[2rem] bg-gradient-to-br from-indigo-500/10 via-slate-900/90 to-slate-950/80 border border-white/10 p-8 shadow-xl">
        <div class="space-y-4">
            <div class="rounded-[1.75rem] bg-slate-950/80 p-6 border border-white/10">
                <p class="text-slate-400">Nama</p>
                <p class="text-white font-semibold">{{ auth()->user()->name }}</p>
            </div>
            <div class="rounded-[1.75rem] bg-slate-950/80 p-6 border border-white/10">
                <p class="text-slate-400">Email</p>
                <p class="text-white font-semibold">{{ auth()->user()->email }}</p>
            </div>
            <div class="rounded-[1.75rem] bg-slate-950/80 p-6 border border-white/10">
                <p class="text-slate-400">Role</p>
                <p class="text-white font-semibold">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
