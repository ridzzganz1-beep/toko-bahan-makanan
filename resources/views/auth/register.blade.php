@extends('layouts.auth')

@section('content')
    <div class="space-y-6 rounded-[2rem] bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 backdrop-blur-xl">
        <div class="text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-violet-500 to-sky-500 text-white shadow-lg shadow-slate-950/30">
                <i class="fa-solid fa-user-plus text-2xl"></i>
            </div>
            <h1 class="text-3xl font-semibold text-white">Buat Akun Baru</h1>
            <p class="mt-3 text-slate-400">Isi data Anda untuk mulai menggunakan aplikasi toko bahan makanan.</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Nama Lengkap</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="name" value="{{ old('name') }}" required class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-violet-500" placeholder="Nama lengkap Anda">
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Email</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-violet-500" placeholder="you@example.com">
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Password</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-violet-500" placeholder="••••••••">
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Konfirmasi Password</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" required class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-violet-500" placeholder="Konfirmasi password Anda">
                </div>
            </div>
            <button type="submit" class="inline-flex w-full items-center justify-center rounded-3xl bg-gradient-to-r from-violet-500 to-sky-500 px-6 py-4 text-base font-semibold text-white shadow-xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl">Register Sekarang</button>
        </form>

        <p class="text-center text-sm text-slate-400">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-sky-300 hover:text-white">Login</a></p>
    </div>
@endsection
