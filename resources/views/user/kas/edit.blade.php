@extends('layouts.user')

@section('content')
<div class="space-y-8">
    <div class="rounded-[40px] border border-slate-200 bg-white p-10 shadow-2xl shadow-slate-200/20">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-500 font-semibold">Edit Setoran</p>
                <h1 class="mt-4 text-4xl font-bold text-slate-900">Perbarui Setoran Anda</h1>
                <p class="mt-3 text-slate-500 max-w-2xl">Edit data setoran agar histori tetap akurat dan lengkap.</p>
            </div>
            <div class="inline-flex items-center gap-3 rounded-3xl bg-slate-100 px-5 py-3 text-slate-700 shadow-sm">
                <i class="fa-solid fa-pencil text-xl"></i>
                <span class="font-semibold">User Edit</span>
            </div>
        </div>
    </div>

    <div class="rounded-[40px] bg-slate-50/90 border border-slate-200 p-10 shadow-lg">
        @if ($errors->any())
            <div class="mb-6 rounded-3xl bg-rose-50 border border-rose-200 p-4 text-rose-700">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.kas.update', $kas->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Nama Warga</label>
                    <input type="text" name="nama_warga" value="{{ old('nama_warga', $kas->nama_warga) }}" class="w-full rounded-3xl border border-slate-300 bg-white/90 py-4 px-5 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" required>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Nominal Setoran</label>
                    <input type="number" name="setoran" value="{{ old('setoran', $kas->setoran) }}" class="w-full rounded-3xl border border-slate-300 bg-white/90 py-4 px-5 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" required>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Kategori Kas</label>
                    <select name="kategori" class="w-full rounded-3xl border border-slate-300 bg-white/90 py-4 px-5 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" required>
                        <option value="Kas Bulanan" {{ old('kategori', $kas->kategori) === 'Kas Bulanan' ? 'selected' : '' }}>Kas Bulanan</option>
                        <option value="Kas Kebersihan" {{ old('kategori', $kas->kategori) === 'Kas Kebersihan' ? 'selected' : '' }}>Kas Kebersihan</option>
                        <option value="Kas Sampah" {{ old('kategori', $kas->kategori) === 'Kas Sampah' ? 'selected' : '' }}>Kas Sampah</option>
                        <option value="Kas Kegiatan" {{ old('kategori', $kas->kategori) === 'Kas Kegiatan' ? 'selected' : '' }}>Kas Kegiatan</option>
                        <option value="Kas Kesehatan" {{ old('kategori', $kas->kategori) === 'Kas Kesehatan' ? 'selected' : '' }}>Kas Kesehatan</option>
                    </select>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full rounded-3xl border border-slate-300 bg-white/90 py-4 px-5 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" required>
                        <option value="Virtual Account" {{ old('payment_method', $kas->payment_method) === 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                        <option value="QRIS" {{ old('payment_method', $kas->payment_method) === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        <option value="Mobile Banking" {{ old('payment_method', $kas->payment_method) === 'Mobile Banking' ? 'selected' : '' }}>Mobile Banking</option>
                        <option value="E-Wallet" {{ old('payment_method', $kas->payment_method) === 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $kas->tanggal->format('Y-m-d')) }}" class="w-full rounded-3xl border border-slate-300 bg-white/90 py-4 px-5 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" required>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-slate-700">Keterangan</label>
                    <textarea name="keterangan" rows="4" class="w-full rounded-3xl border border-slate-300 bg-white/90 px-5 py-4 text-lg text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" placeholder="Opsional, misalnya iuran bulan Mei">{{ old('keterangan', $kas->keterangan) }}</textarea>
                </div>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:justify-end">
                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 bg-white px-8 py-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-500 px-8 py-4 text-sm font-semibold text-white shadow-xl shadow-emerald-500/20 transition hover:bg-emerald-600">Perbarui Setoran</button>
            </div>
        </form>
    </div>
</div>
@endsection
