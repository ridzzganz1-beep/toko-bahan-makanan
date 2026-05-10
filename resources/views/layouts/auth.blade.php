<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - Toko Bahan Makanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            100: '#eef2ff',
                            500: '#3b82f6',
                            700: '#1d4ed8',
                            900: '#0f172a'
                        }
                    },
                    boxShadow: {
                        glass: '0 25px 50px -12px rgba(15, 23, 42, 0.35)'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.4/css/all.min.css" integrity="sha512-xh6l8m5G1pS6CPo4eFqKx8cP7czVq9r2j6M7AqWUp5fUiyTkGTD6dv8QDW7pi6+S5K+xjG8ioKT+/2wOfQM71w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Inter, sans-serif;
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .auth-input:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.18);
        }
        .fade-in {
            animation: fadeIn 0.9s ease-out forwards;
            opacity: 0;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 opacity-90"></div>
        <div class="absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.3),_transparent_35%)] pointer-events-none"></div>
        <div class="absolute inset-x-0 bottom-0 h-72 bg-[radial-gradient(circle_at_bottom,_rgba(168,85,247,0.24),_transparent_35%)] pointer-events-none"></div>

        <div class="relative flex min-h-screen items-center justify-center px-6 py-10">
            <div class="glass-card w-full max-w-5xl overflow-hidden rounded-[2rem] shadow-glass border border-white/10">
                <div class="grid gap-6 lg:grid-cols-[1.2fr_1fr]">
                    <div class="hidden lg:flex flex-col justify-center px-12 py-16 bg-slate-900/80">
                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200 shadow-sm">
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-500 text-white shadow"> <i class="fa-solid fa-leaf"></i> </span>
                                <span>Toko Bahan Makanan</span>
                            </div>
                            <div class="space-y-4">
                                <h2 class="text-4xl font-semibold tracking-tight text-white">Aplikasi Transaksi Bahan Makanan</h2>
                                <p class="max-w-xl text-slate-300">Login atau daftar untuk mengelola produk dan transaksi pembelian dengan tampilan modern, responsif, dan profesional.</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl bg-slate-950/70 p-5 shadow-sm ring-1 ring-white/10">
                                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Fitur</p>
                                    <ul class="mt-4 space-y-3 text-slate-200">
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Autentikasi aman</li>
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Validasi form rapi</li>
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Dashboard eksklusif</li>
                                    </ul>
                                </div>
                                <div class="rounded-3xl bg-slate-950/70 p-5 shadow-sm ring-1 ring-white/10">
                                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Design</p>
                                    <ul class="mt-4 space-y-3 text-slate-200">
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Glassmorphism</li>
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Animasi smooth</li>
                                        <li class="flex items-start gap-3"><span class="mt-1 text-indigo-400"><i class="fa-solid fa-check"></i></span> Mobile-friendly</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-10 sm:px-10 sm:py-12">
                        <div class="mx-auto max-w-md fade-in">
                            @if (session('success'))
                                <div class="mb-6 rounded-3xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm text-emerald-100 shadow-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-6 rounded-3xl border border-rose-400/20 bg-rose-500/10 p-4 text-sm text-rose-100 shadow-sm">
                                    <ul class="space-y-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    const button = form.querySelector('button[type="submit"]');
                    if (button) {
                        button.disabled = true;
                        button.innerHTML = '<span class="inline-flex items-center gap-2"><svg class="h-5 w-5 animate-spin text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>Loading...</span>';
                    }
                });
            });
        });
    </script>
</body>
</html>
