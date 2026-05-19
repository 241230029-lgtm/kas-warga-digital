@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <section class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-10 shadow-2xl shadow-slate-950/40 text-slate-100">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-500 font-semibold">Admin Kas</p>
                <h1 class="mt-4 text-4xl font-bold text-slate-900">Kelola Transaksi Warga</h1>
                <p class="mt-3 text-slate-500 max-w-2xl">Lihat semua catatan setoran, edit data transaksi, dan tambahkan setoran baru langsung dari panel admin.</p>
            </div>
            <a href="{{ route('kas.create') }}" class="inline-flex items-center gap-3 rounded-3xl bg-emerald-500 px-6 py-3 text-slate-950 font-semibold shadow-lg shadow-emerald-500/20 hover:bg-emerald-400 transition">
                <i class="fa-solid fa-plus"></i>
                Tambah Transaksi
            </a>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
                <p class="text-sm text-slate-300">Total Transaksi</p>
                <p class="mt-4 text-4xl font-bold">{{ $kasData->count() }}</p>
            </div>
            <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
                <p class="text-sm text-slate-300">Total Saldo</p>
                <p class="mt-4 text-4xl font-bold">Rp {{ number_format($kasData->sum('setoran'), 0, ',', '.') }}</p>
            </div>
            <div class="rounded-[32px] bg-slate-950/95 p-6 text-white shadow-xl">
                <p class="text-sm text-slate-300">Periode</p>
                <p class="mt-4 text-4xl font-bold">{{ date('F Y') }}</p>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="rounded-[32px] border border-emerald-200 bg-emerald-50 p-5 text-emerald-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <section class="rounded-[40px] border border-slate-800 bg-slate-900/95 p-6 shadow-lg">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Riwayat Transaksi</h2>
                <p class="mt-2 text-slate-400">Daftar setoran kas yang tercatat di sistem.</p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">
                <i class="fa-solid fa-history"></i>
                Terbaru
            </div>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-300">
                <thead class="border-b border-slate-800 bg-slate-900 text-slate-400 uppercase tracking-[0.2em] text-xs">
                    <tr>
                        <th class="px-6 py-4">Nama Warga</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Bayar ke</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($kasData as $item)
                        <tr class="hover:bg-slate-900/80 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-3xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">{{ strtoupper(substr($item->nama_warga, 0, 1)) }}</div>
                                    <div>
                                        <p class="font-semibold text-white">{{ $item->nama_warga }}</p>
                                        <p class="text-xs text-slate-400">ID-{{ 1000 + $item->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-slate-200">{{ $item->kategori ?? 'Umum' }}</td>
                            <td class="px-6 py-5 text-slate-200">{{ $item->user?->name ?? 'Admin / tidak terikat' }}</td>
                            <td class="px-6 py-5 font-semibold text-white">Rp {{ number_format($item->setoran, 0, ',', '.') }}</td>
                            <td class="px-6 py-5 text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            <td class="px-6 py-5 text-slate-200">{{ $item->payment_method ?? 'Virtual Account' }}</td>
                            <td class="px-6 py-5 text-slate-200">{{ $item->destination ?? 'Bendahara' }}</td>
                            <td class="px-6 py-5 text-center">
                                <div class="inline-flex items-center justify-center gap-2">
                                                            <a href="{{ route('kas.edit', $item->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-800 px-4 py-3 text-slate-200 hover:bg-slate-700 transition">
                                        <i class="fa-solid fa-pen"></i>
                                        <span class="text-sm">Edit</span>
                                    </a>
                                    <form action="{{ route('kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-rose-600/10 px-4 py-3 text-rose-400 hover:bg-rose-600/20 transition">
                                            <i class="fa-solid fa-trash"></i>
                                            <span class="text-sm">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-slate-400">
                                <div class="space-y-3">
                                    <div class="mx-auto h-20 w-20 rounded-full bg-slate-100 text-emerald-500 flex items-center justify-center text-3xl">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </div>
                                    <p class="text-lg font-semibold">Belum ada transaksi kas.</p>
                                    <p class="text-sm text-slate-500">Tambahkan transaksi baru agar data kas segera tercatat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
