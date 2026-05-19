@extends('layouts.user')

@section('content')
<div class="space-y-8">
    <div class="rounded-[40px] border border-slate-800 bg-slate-900/95 p-10 shadow-2xl shadow-slate-950/40 text-slate-100">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-300 font-semibold">Tambah Setoran</p>
                <h1 class="mt-4 text-4xl font-bold text-white">Catat Setoran Baru</h1>
                <p class="mt-3 text-slate-400 max-w-2xl">Isi detail setoran kas Anda agar histori pembayaran tetap terkelola.</p>
            </div>
            <div class="inline-flex items-center gap-3 rounded-3xl bg-emerald-500/10 px-5 py-3 text-emerald-200 shadow-sm">
                <i class="fa-solid fa-wallet text-xl"></i>
                <span class="font-semibold">User Form</span>
            </div>
        </div>
    </div>

    <div x-data="{ transactionCategory:'{{ old('kategori', 'Kas Bulanan') }}', paymentMethod:'{{ old('payment_method', 'Virtual Account') }}', paymentDestination:'Bendahara' }" x-effect="paymentDestination = transactionCategory === 'Kas Kebersihan' ? 'Ketua RT' : transactionCategory === 'Kas Sampah' ? 'Dinas Kebersihan' : transactionCategory === 'Kas Kegiatan' ? 'Panitia Kegiatan' : 'Bendahara'" class="rounded-[40px] bg-slate-950/95 border border-slate-800 p-10 shadow-lg text-slate-100">
        @if ($errors->any())
            <div class="mb-6 rounded-3xl bg-rose-600/10 border border-rose-600/20 p-4 text-rose-200">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.kas.store') }}" method="POST" class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
            @csrf

            <div class="space-y-6 rounded-[32px] border border-slate-800 bg-slate-900/90 p-6">
                <div class="space-y-4">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Detail Transaksi</p>
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Nama Warga</label>
                            <input type="text" name="nama_warga" value="{{ old('nama_warga') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" placeholder="Nama lengkap" required>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-300">Nominal Setoran</label>
                            <input type="number" name="setoran" value="{{ old('setoran') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" placeholder="500000" required>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Kategori Kas</label>
                        <select x-model="transactionCategory" name="kategori" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                            <option value="Kas Bulanan" {{ old('kategori', 'Kas Bulanan') === 'Kas Bulanan' ? 'selected' : '' }}>Kas Bulanan</option>
                            <option value="Kas Kebersihan" {{ old('kategori', 'Kas Bulanan') === 'Kas Kebersihan' ? 'selected' : '' }}>Kas Kebersihan</option>
                            <option value="Kas Sampah" {{ old('kategori', 'Kas Bulanan') === 'Kas Sampah' ? 'selected' : '' }}>Kas Sampah</option>
                            <option value="Kas Kegiatan" {{ old('kategori', 'Kas Bulanan') === 'Kas Kegiatan' ? 'selected' : '' }}>Kas Kegiatan</option>
                            <option value="Kas Kesehatan" {{ old('kategori', 'Kas Bulanan') === 'Kas Kesehatan' ? 'selected' : '' }}>Kas Kesehatan</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Metode Pembayaran</label>
                        <select x-model="paymentMethod" name="payment_method" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                            <option value="Virtual Account" {{ old('payment_method', 'Virtual Account') === 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                            <option value="QRIS" {{ old('payment_method', 'Virtual Account') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Mobile Banking" {{ old('payment_method', 'Virtual Account') === 'Mobile Banking' ? 'selected' : '' }}>Mobile Banking</option>
                            <option value="E-Wallet" {{ old('payment_method', 'Virtual Account') === 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Keterangan</label>
                        <textarea name="keterangan" rows="4" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-5 py-4 text-lg text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" placeholder="Opsional, misalnya iuran bulan April">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                <div class="space-y-4 rounded-[32px] bg-slate-950/95 p-5 border border-slate-800">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Ringkasan Metode Pembayaran</p>
                    <div class="grid gap-4">
                        <div class="rounded-3xl border border-slate-700 bg-slate-900/90 p-4">
                            <p class="text-sm text-slate-400">Metode dipilih</p>
                            <p class="mt-2 font-semibold text-white" x-text="paymentMethod"></p>
                        </div>
                        <div class="rounded-3xl border border-slate-700 bg-slate-900/90 p-4">
                            <p class="text-sm text-slate-400">Bayar ke</p>
                            <p class="mt-2 font-semibold text-white" x-text="paymentDestination"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6 rounded-[32px] border border-slate-800 bg-slate-950/90 p-6">
                <div class="rounded-[32px] bg-slate-900/90 p-6 border border-slate-800 shadow-inner">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Ringkasan Transaksi</p>
                    <div class="mt-6 space-y-4 text-slate-300">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm text-slate-400">Nominal Pembayaran</span>
                            <span class="font-semibold text-white">Rp {{ old('setoran', '0') }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm text-slate-400">Tanggal</span>
                            <span class="font-semibold text-white">{{ old('tanggal', date('Y-m-d')) }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm text-slate-400">Nomor Referensi</span>
                            <span class="font-semibold text-white">TXN-{{ now()->format('YmdHis') }}</span>
                        </div>
                        <div class="rounded-3xl border border-slate-700 bg-slate-900/90 p-4">
                            <p class="text-sm text-slate-400">Metode</p>
                            <p class="mt-1 font-semibold text-white">Pilih salah satu metode pembayaran di atas</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[32px] border border-slate-800 bg-slate-900/95 p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="mt-1 inline-flex h-3 w-3 rounded-full bg-emerald-400"></span>
                        <div>
                            <p class="text-sm font-semibold text-white">Tampilan Pembayaran Realistis</p>
                            <p class="mt-1 text-sm text-slate-400">Form ini hanya meniru pengalaman checkout digital, tetapi data setoran akan tetap tercatat di sistem.</p>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-slate-950/90 p-4 border border-slate-700">
                        <p class="text-sm text-slate-400">Instruksi Bayar</p>
                        <ul class="mt-3 list-disc space-y-2 pl-5 text-slate-300">
                            <li>Pilih metode pembayaran yang ingin kamu gunakan.</li>
                            <li>Pastikan nominal dan tanggal sudah sesuai.</li>
                            <li>Tekan tombol simpan untuk menyelesaikan catatan setoran.</li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="rounded-3xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-xl shadow-emerald-500/20 transition hover:bg-emerald-400">Simpan Setoran</button>
                    <a href="{{ route('user.dashboard') }}" class="rounded-3xl border border-slate-700 bg-slate-900 px-5 py-3 text-sm font-semibold text-slate-200 text-center">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
