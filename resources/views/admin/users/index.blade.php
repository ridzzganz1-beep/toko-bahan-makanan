@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Kelola User</h1>
            <p class="text-slate-400">Daftar akun pelanggan dan administrator.</p>
        </div>
    </div>

    <div class="rounded-[2rem] bg-slate-900/80 border border-white/10 shadow-xl overflow-x-auto">
        <table class="min-w-full text-left text-slate-300">
            <thead class="border-b border-white/10 bg-slate-950/90 text-sm uppercase tracking-[0.2em] text-slate-500">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Tanggal Dibuat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $user)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">{{ $users->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-semibold text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-slate-800/70 px-3 py-1 text-sm font-semibold text-slate-300">{{ ucfirst($user->role) }}</span></td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full bg-slate-800/70 px-4 py-2 text-sm font-semibold text-slate-200 hover:bg-slate-700 transition-all">Edit</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full bg-rose-500/20 px-4 py-2 text-sm font-semibold text-rose-200 hover:bg-rose-500/30 transition-all">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
