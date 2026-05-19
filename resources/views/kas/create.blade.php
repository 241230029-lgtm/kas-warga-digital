@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="rounded-[40px] border border-slate-800 bg-slate-900/95 p-10 shadow-2xl shadow-slate-950/40 text-slate-100">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-300 font-semibold">Halaman Admin</p>
                <h1 class="mt-4 text-4xl font-bold text-white">Tambah Transaksi Kas</h1>
                <p class="mt-3 text-slate-400 max-w-2xl">Form transaksi ini tetap berada di panel admin. Isi detail setoran warga secara cepat dan aman.</p>
            </div>
            <div class="inline-flex items-center gap-3 rounded-3xl bg-emerald-500/10 px-5 py-3 text-emerald-200 shadow-sm">
                <i class="fa-solid fa-file-circle-plus text-xl"></i>
                <span class="font-semibold">Admin Form</span>
            </div>
        </div>
    </div>

    <div class="rounded-[40px] bg-slate-950/95 border border-slate-800 p-10 shadow-lg text-slate-100">
        @if ($errors->any())
            <div class="mb-6 rounded-3xl bg-rose-600/10 border border-rose-600/20 p-4 text-rose-200">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kas.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Nama Warga</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="nama_warga" value="{{ old('nama_warga') }}" placeholder="Masukkan nama warga" class="w-full rounded-3xl border border-slate-700 bg-slate-900 py-4 pl-12 pr-4 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Nominal Setoran</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">Rp</span>
                        <input type="number" name="setoran" value="{{ old('setoran') }}" placeholder="500000" class="w-full rounded-3xl border border-slate-700 bg-slate-900 py-4 pl-14 pr-4 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Kategori Kas</label>
                    <select name="kategori" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                        <option value="">Pilih kategori</option>
                        <option value="Kas Bulanan" {{ old('kategori') === 'Kas Bulanan' ? 'selected' : '' }}>Kas Bulanan</option>
                        <option value="Kas Kebersihan" {{ old('kategori') === 'Kas Kebersihan' ? 'selected' : '' }}>Kas Kebersihan</option>
                        <option value="Kas Sampah" {{ old('kategori') === 'Kas Sampah' ? 'selected' : '' }}>Kas Sampah</option>
                        <option value="Kas Kegiatan" {{ old('kategori') === 'Kas Kegiatan' ? 'selected' : '' }}>Kas Kegiatan</option>
                        <option value="Kas Kesehatan" {{ old('kategori') === 'Kas Kesehatan' ? 'selected' : '' }}>Kas Kesehatan</option>
                    </select>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                        <option value="">Pilih metode</option>
                        <option value="Virtual Account" {{ old('payment_method') === 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                        <option value="QRIS" {{ old('payment_method') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        <option value="Mobile Banking" {{ old('payment_method') === 'Mobile Banking' ? 'selected' : '' }}>Mobile Banking</option>
                        <option value="E-Wallet" {{ old('payment_method') === 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Bayar ke</label>
                    <input list="destination-options" name="destination" value="{{ old('destination') }}" placeholder="Contoh: Bendahara" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20">
                    <datalist id="destination-options">
                        <option value="Bendahara"></option>
                        <option value="Ketua RT"></option>
                        <option value="Dinas Kebersihan"></option>
                        <option value="Panitia Kegiatan"></option>
                        <option value="Dinas Kesehatan"></option>
                    </datalist>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Tanggal Pembayaran</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-900 py-4 pl-12 pr-4 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-300">Keterangan (opsional)</label>
                    <textarea name="keterangan" rows="4" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-5 py-4 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-end">
                <a href="{{ route('kas.index') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-700 bg-slate-900 px-8 py-4 text-sm font-semibold text-slate-100 transition hover:bg-slate-800">Batal</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-500 px-8 py-4 text-sm font-semibold text-slate-900 shadow-xl shadow-emerald-500/20 transition hover:bg-emerald-400">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>
@endsection
