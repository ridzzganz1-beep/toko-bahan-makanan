@extends('layouts.auth')

@section('content')
    <div class="space-y-6 rounded-[2rem] bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 backdrop-blur-xl text-center">
        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-rose-500/20 text-rose-400 shadow-lg shadow-slate-950/20">
            <i class="fa-solid fa-shield-halved text-3xl"></i>
        </div>

        <h1 class="text-4xl font-semibold text-white">403 - Akses Ditolak</h1>
        <p class="text-slate-400">Anda tidak memiliki izin untuk mengakses halaman ini. Hubungi administrator atau masuk dengan akun yang sesuai.</p>

        <div class="grid gap-4 sm:grid-cols-2">
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-3xl bg-indigo-500 px-6 py-4 text-white font-semibold hover:bg-indigo-400 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Login
            </a>
            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2 rounded-3xl bg-slate-800/80 px-6 py-4 text-slate-200 border border-white/10 hover:bg-slate-700 transition-all">
                <i class="fa-solid fa-rotate-left"></i>
                Kembali Sebelumnya
            </a>
        </div>
    </div>
@endsection
