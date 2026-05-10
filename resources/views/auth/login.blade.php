@extends('layouts.auth')

@section('content')
    <div class="space-y-6 rounded-[2rem] bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 backdrop-blur-xl">
        <div class="text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-indigo-500 to-sky-500 text-white shadow-lg shadow-slate-950/30">
                <i class="fa-solid fa-shop text-2xl"></i>
            </div>
            <h1 class="text-3xl font-semibold text-white">Selamat Datang</h1>
            <p class="mt-3 text-slate-400">Masuk untuk mengelola data barang dan transaksi toko bahan makanan Anda.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Email</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500" placeholder="you@example.com">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-300">Password</label>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-950/70 shadow-sm">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required class="auth-input w-full rounded-3xl border-0 bg-transparent py-4 pl-12 pr-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500" placeholder="••••••••">
                </div>
            </div>

            <label class="inline-flex items-center gap-3 text-sm text-slate-300">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-indigo-500 focus:ring-indigo-400">
                Remember Me
            </label>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-3xl bg-gradient-to-r from-indigo-500 to-sky-500 px-6 py-4 text-base font-semibold text-white shadow-xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl">Login Sekarang</button>
        </form>

        <p class="text-center text-sm text-slate-400">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-sky-300 hover:text-white">Register</a></p>

        <!-- Test Accounts Info -->
        <div class="mt-8 space-y-4 rounded-2xl bg-slate-950/50 p-4 border border-white/5">
            <p class="text-center text-xs uppercase tracking-widest text-slate-500 font-semibold">Akun Testing</p>
            
            <div class="grid gap-3">
                <!-- Admin Account -->
                <div class="rounded-lg bg-indigo-500/10 border border-indigo-500/20 p-3">
                    <p class="text-xs font-semibold text-indigo-300 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-shield-admin text-sm"></i> Admin
                    </p>
                    <p class="text-xs text-slate-400">Email: <span class="text-white font-mono">admin@gmail.com</span></p>
                    <p class="text-xs text-slate-400">Password: <span class="text-white font-mono">admin123</span></p>
                </div>
                
                <!-- User Account -->
                <div class="rounded-lg bg-sky-500/10 border border-sky-500/20 p-3">
                    <p class="text-xs font-semibold text-sky-300 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-user text-sm"></i> User/Pelanggan
                    </p>
                    <p class="text-xs text-slate-400">Email: <span class="text-white font-mono">user@gmail.com</span></p>
                    <p class="text-xs text-slate-400">Password: <span class="text-white font-mono">user123</span></p>
                </div>
            </div>
            
            <p class="text-center text-xs text-slate-500 pt-2 border-t border-white/5">
                Admin masuk ke dashboard admin • User masuk ke dashboard pelanggan
            </p>
        </div>
    </div>
@endsection
