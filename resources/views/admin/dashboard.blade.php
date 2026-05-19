@extends('layouts.admin')

@section('content')
<div x-data="{ showAddForm: window.location.hash === '#add' }" x-init="window.addEventListener('hashchange', ()=>{ showAddForm = (location.hash === '#add') })" class="space-y-10">
    @if(session('success'))
        <div class="rounded-[32px] border border-emerald-500/20 bg-emerald-500/10 p-5 text-emerald-200 shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="rounded-[32px] border border-rose-500/20 bg-rose-500/10 p-5 text-rose-200 shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-8 shadow-2xl shadow-slate-950/40 text-slate-100">
            <p class="text-sm text-emerald-300 font-semibold uppercase tracking-[0.3em]">Admin Dashboard</p>
            <h1 class="mt-4 text-4xl font-bold text-white">Halo, {{ auth()->user()->name }}</h1>
            <p class="mt-3 text-slate-400 max-w-2xl">Kelola seluruh kas warga, buat laporan keuangan, dan pantau aktivitas operasional dari panel admin yang terpusat.</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <a href="{{ route('kas.index') }}" class="rounded-[32px] border border-slate-800 bg-slate-950/90 px-6 py-5 text-slate-100 shadow-sm transition hover:bg-slate-800 hover:text-white">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-3xl bg-emerald-500 text-slate-950 flex items-center justify-center">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Kelola Kas</p>
                            <p class="text-sm text-slate-400">Tambah, edit, atau hapus catatan kas.</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('kas.index') }}" class="rounded-[32px] border border-slate-800 bg-slate-950/90 px-6 py-5 text-slate-100 shadow-sm transition hover:bg-slate-800 hover:text-white">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-3xl bg-sky-500 text-slate-950 flex items-center justify-center">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Riwayat Transaksi</p>
                            <p class="text-sm text-slate-400">Lihat catatan semua transaksi kas.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="rounded-[40px] bg-gradient-to-br from-slate-950 to-emerald-800 p-8 text-white shadow-xl shadow-slate-950/30">
            <div class="flex items-center justify-between gap-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-emerald-200/90">Ringkasan Cepat</p>
                    <h2 class="mt-4 text-3xl font-bold">Statistik Hari Ini</h2>
                </div>
                <div class="rounded-3xl bg-white/10 px-4 py-3 text-sm">Admin</div>
            </div>

            <div class="mt-8 grid gap-4">
                <div class="rounded-3xl bg-white/10 p-6">
                    <p class="text-sm text-slate-200">Total Transaksi</p>
                    <p class="mt-3 text-4xl font-bold">{{ $kasData->count() }}</p>
                </div>
                <div class="rounded-3xl bg-white/10 p-6">
                    <p class="text-sm text-slate-200">Total Saldo</p>
                    <p class="mt-3 text-4xl font-bold">Rp {{ number_format($kasData->sum('setoran'), 0, ',', '.') }}</p>
                </div>
                <div class="rounded-3xl bg-white/10 p-6">
                    <p class="text-sm text-slate-200">Pengguna</p>
                    <p class="mt-3 text-4xl font-bold">{{ $usersCount }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1.4fr_0.8fr]">
        <div class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-8 shadow-sm text-slate-100">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Transaksi Terbaru</h2>
                    <p class="mt-2 text-sm text-slate-400">Lihat catatan kas terakhir yang diinputkan.</p>
                </div>
                <button type="button" @click="showAddForm = !showAddForm; if(showAddForm){ location.hash = '#add' } else { history.replaceState(null,'',location.pathname) }" class="inline-flex items-center gap-2 rounded-3xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/20 hover:bg-emerald-400 transition">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Transaksi
                </button>
            </div>

            <div x-show="showAddForm" x-cloak x-transition class="mt-6 rounded-[32px] border border-slate-800 bg-slate-950/95 p-6">
                <h3 class="text-xl font-bold text-white">Form Tambah Transaksi</h3>
                <p class="mt-2 text-sm text-slate-400">Tetap di halaman admin; isi data tanpa berpindah.</p>

                <form action="{{ route('kas.store') }}" method="POST" class="mt-6 grid gap-6">
                    @csrf

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Nama Warga</label>
                            <input type="text" name="nama_warga" value="{{ old('nama_warga') }}" placeholder="Masukkan nama warga" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-4 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20" required>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Nominal Setoran</label>
                            <input type="number" name="setoran" value="{{ old('setoran') }}" placeholder="500000" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-4 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20" required>
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-4 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20" required>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Keterangan (opsional)</label>
                            <textarea name="keterangan" rows="4" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-5 py-4 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <button type="button" @click="showAddForm = false; history.replaceState(null,'',location.pathname)" class="rounded-3xl border border-slate-700 bg-slate-900 px-5 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800">Batal</button>
                        <button type="submit" class="rounded-3xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-xl shadow-emerald-500/25 hover:bg-emerald-400">Simpan Transaksi</button>
                    </div>
                </form>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-left text-sm text-slate-300">
                    <thead class="border-b border-slate-800 text-slate-400 uppercase tracking-[0.2em] text-xs">
                        <tr>
                            <th class="px-6 py-4">Warga</th>
                            <th class="px-6 py-4">Nominal</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Pemilik</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($kasData as $item)
                            <tr class="hover:bg-slate-900/80 transition">
                                <td class="px-6 py-5 font-medium text-white">{{ $item->nama_warga }}</td>
                                <td class="px-6 py-5">Rp {{ number_format($item->setoran, 0, ',', '.') }}</td>
                                <td class="px-6 py-5">{{ $item->tanggal->format('d M Y') }}</td>
                                <td class="px-6 py-5">{{ $item->user?->name ?? 'Admin / tidak terikat' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500">Belum ada transaksi kas yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-8 shadow-sm text-slate-100">
                <h3 class="text-xl font-bold text-white">Aktivitas Terakhir</h3>
                <p class="mt-2 text-sm text-slate-400">Rekam jejak admin terbaru dan penambahan transaksi.</p>

                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-950/90 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-white">Setoran Baru</p>
                                <p class="text-sm text-slate-400">Transaksi kas berhasil ditambahkan.</p>
                            </div>
                            <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-200">Terbaru</span>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-slate-950/90 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-white">Laporan Keuangan</p>
                                <p class="text-sm text-slate-400">Lihat ringkasan saldo kas.</p>
                            </div>
                            <span class="rounded-full bg-slate-800 px-3 py-1 text-xs font-semibold text-slate-300">Lihat</span>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-slate-950/90 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-white">Kelola Pengguna</p>
                                <p class="text-sm text-slate-400">Pastikan semua transaksi ditugaskan ke user yang tepat.</p>
                            </div>
                            <span class="rounded-full bg-slate-800 px-3 py-1 text-xs font-semibold text-slate-300">Akses</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[40px] bg-slate-900/95 border border-slate-800 p-8 shadow-sm text-slate-100">
                <h3 class="text-xl font-bold text-white">Quick Insights</h3>
                <div class="mt-6 grid gap-4">
                    <div class="rounded-3xl bg-emerald-500/10 p-5">
                        <p class="text-sm text-emerald-200">Sistem berjalan normal.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-950/90 p-5">
                        <p class="text-sm text-slate-300">Semua transaksi terbaru sudah tercatat dengan baik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
