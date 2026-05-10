@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-white transition-colors"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h1 class="text-3xl font-bold text-white">Edit User</h1>
            <p class="text-slate-400">Perbarui informasi user dan role akses.</p>
        </div>
    </div>

    <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 p-8 shadow-xl">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-300 mb-2">Role</label>
                <select name="role" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/20">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-3 text-white font-semibold shadow-lg hover:scale-[1.02] transition-transform">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
