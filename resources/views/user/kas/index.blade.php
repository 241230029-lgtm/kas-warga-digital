@extends('layouts.user')

@section('content')
<div class="space-y-8">
    <div class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-10 shadow-2xl shadow-slate-950/40 text-slate-100">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-300 font-semibold">Panel Warga</p>
                <h1 class="mt-4 text-4xl font-bold text-white">Riwayat Setoran Anda</h1>
                <p class="mt-3 text-slate-400 max-w-2xl">Kelola setoran kas pribadi Anda tanpa keluar dari halaman user.</p>
            </div>
            <a href="{{ route('user.kas.create') }}" class="inline-flex items-center gap-3 rounded-3xl bg-emerald-500 px-6 py-3 text-slate-950 font-semibold shadow-lg shadow-emerald-500/20 hover:bg-emerald-400 transition">
                <i class="fa-solid fa-plus"></i>
                Tambah Setoran
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-[32px] border border-emerald-600/20 bg-emerald-600/10 p-5 text-emerald-200 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
            <p class="text-sm text-slate-300">Total Setoran</p>
            <p class="mt-4 text-4xl font-bold">{{ $kasData->count() }}</p>
        </div>
        <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
            <p class="text-sm text-slate-300">Saldo Anda</p>
            <p class="mt-4 text-4xl font-bold">Rp {{ number_format($kasData->sum('setoran'), 0, ',', '.') }}</p>
        </div>
        <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
            <p class="text-sm text-slate-300">Terakhir Diperbarui</p>
            <p class="mt-4 text-4xl font-bold">{{ $kasData->first()?->tanggal?->format('d M Y') ?? '-' }}</p>
        </div>
    </div>

    <div class="overflow-x-auto rounded-[40px] border border-slate-800 bg-slate-900/95 shadow-lg">
        <table class="min-w-full text-left text-sm text-slate-300">
            <thead class="border-b border-slate-800 bg-slate-900 text-slate-400 uppercase tracking-[0.2em] text-xs">
                <tr>
                    <th class="px-6 py-4">Nama Warga</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Nominal</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Metode</th>
                    <th class="px-6 py-4">Bayar ke</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($kasData as $item)
                    <tr class="hover:bg-slate-900/80">
                        <td class="px-6 py-5">
                            <p class="font-semibold text-white">{{ $item->nama_warga }}</p>
                        </td>
                        <td class="px-6 py-5 text-slate-200">{{ $item->kategori ?? 'Umum' }}</td>
                        <td class="px-6 py-5 text-white">Rp {{ number_format($item->setoran, 0, ',', '.') }}</td>
                        <td class="px-6 py-5 text-slate-400">{{ $item->tanggal->format('d M Y') }}</td>
                        <td class="px-6 py-5 text-slate-200">{{ $item->payment_method ?? 'Virtual Account' }}</td>
                        <td class="px-6 py-5 text-slate-200">{{ $item->destination ?? 'Bendahara' }}</td>
                        <td class="px-6 py-5 text-center">
                            <div class="inline-flex items-center justify-center gap-2">
                                <a href="{{ route('user.kas.edit', $item->id) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-800 text-slate-200 hover:bg-slate-700 transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('user.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus setoran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-600/10 text-rose-400 hover:bg-rose-600/20 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                            <div class="space-y-3">
                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-800 text-emerald-400 text-3xl">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <p class="text-lg font-semibold">Belum ada setoran.</p>
                                <p class="text-sm text-slate-500">Klik tombol Tambah Setoran untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
