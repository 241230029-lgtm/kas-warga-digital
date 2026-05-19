@extends('layouts.user')

@section('content')
<div x-data="{ showAddForm:false, transactionCategory:'{{ old('kategori', 'Kas Bulanan') }}', paymentMethod:'{{ old('payment_method', 'Virtual Account') }}', paymentDestination:'Bendahara' }" x-effect="paymentDestination = transactionCategory === 'Kas Kebersihan' ? 'Ketua RT' : transactionCategory === 'Kas Sampah' ? 'Dinas Kebersihan' : transactionCategory === 'Kas Kegiatan' ? 'Panitia Kegiatan' : 'Bendahara'" class="space-y-10">
    @if(session('success'))
        <div class="rounded-[32px] border border-emerald-200 bg-emerald-50 p-5 text-emerald-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    <section class="grid gap-6 xl:grid-cols-[1.3fr_0.9fr]">
        <div class="rounded-[40px] glass-card border border-white/10 p-8 shadow-2xl shadow-slate-950/20">
            <div class="flex flex-col gap-3">
                <h1 class="text-4xl font-bold text-white">Hallo, warga yang bahagia</h1>
                <p class="max-w-3xl text-slate-300">Pantau laporan setoran Anda secara real time, buat catatan kas dengan mudah, dan ikuti perkembangan keuangan RT/RW dengan tampilan modern.</p>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-3">
                <div class="rounded-[32px] bg-slate-950/80 p-6 border border-white/10 shadow-xl">
                    <p class="text-sm text-slate-400">Total Setoran</p>
                    <p class="mt-4 text-3xl font-bold text-white">{{ $kasData->count() }}</p>
                </div>
                <div class="rounded-[32px] bg-slate-950/80 p-6 border border-white/10 shadow-xl">
                    <p class="text-sm text-slate-400">Total Nominal</p>
                    <p class="mt-4 text-3xl font-bold text-white">Rp {{ number_format($kasData->sum('setoran'), 0, ',', '.') }}</p>
                </div>
                <div class="rounded-[32px] bg-slate-950/80 p-6 border border-white/10 shadow-xl">
                    <p class="text-sm text-slate-400">Periode</p>
                    <p class="mt-4 text-3xl font-bold text-white">{{ date('F Y') }}</p>
                </div>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2">
                <div class="rounded-[32px] bg-emerald-500/10 p-6 border border-emerald-500/20">
                    <p class="text-sm text-emerald-200">Status Akun</p>
                    <p class="mt-3 text-2xl font-semibold text-white">Aktif</p>
                    <p class="mt-2 text-sm text-slate-300">Selamat! Anda dapat membuat setoran dan melihat histori kapan saja.</p>
                </div>
                <div class="rounded-[32px] bg-slate-900/90 p-6 border border-white/10">
                    <p class="text-sm text-slate-400">Tip Cepat</p>
                    <ul class="mt-4 space-y-3 text-slate-300">
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>Gunakan tombol "Tambah Setoran" agar riwayat Anda otomatis tercatat.</li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>Periksa daftar setoran untuk memastikan nominal sudah benar.</li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>Kirim bukti pembayaran ke pengurus jika diperlukan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="rounded-[40px] glass-card border border-white/10 p-8 shadow-2xl shadow-slate-950/20">
            <h2 class="text-2xl font-bold text-white">Aksi Cepat</h2>
            <p class="mt-2 text-slate-300">Kelola setoran Anda dan lihat status akun langsung dari sini.</p>

            <div class="mt-8 grid gap-4">
                <button type="button" @click="showAddForm = true" class="rounded-[32px] bg-gradient-to-r from-emerald-500 to-sky-500 px-6 py-5 text-white font-semibold shadow-xl shadow-emerald-500/20 transition hover:scale-[1.01]">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-emerald-200">Data Kas</p>
                            <p class="mt-2 text-lg font-semibold">Tambah Setoran Baru</p>
                        </div>
                        <i class="fa-solid fa-plus text-2xl"></i>
                    </div>
                </button>
                <a href="{{ route('user.kas.index') }}" class="rounded-[32px] bg-slate-900/90 px-6 py-5 border border-white/10 text-slate-100 shadow-lg transition hover:bg-slate-800">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Riwayat</p>
                            <p class="mt-2 text-lg font-semibold">Lihat Riwayat Setoran</p>
                        </div>
                        <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <div x-show="showAddForm" x-cloak x-transition class="rounded-[40px] border border-slate-800 bg-slate-950/95 p-6 shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-emerald-300 font-semibold">Tambah Setoran</p>
                <h3 class="mt-2 text-2xl font-bold text-white">Bayar Setoran Seperti Transaksi Online</h3>
                <p class="mt-2 text-slate-400 max-w-2xl">Pilih metode pembayaran, isi detail transaksi, dan simulasikan proses setoran seakan sedang checkout.</p>
            </div>
            <button @click="showAddForm=false" class="rounded-full bg-slate-900/60 px-3 py-2 text-slate-300">Tutup</button>
        </div>

        <form action="{{ route('user.kas.store') }}" method="POST" class="mt-6 grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
            @csrf

            <div class="space-y-6 rounded-[32px] border border-slate-800 bg-slate-900/90 p-6">
                <div class="space-y-4">
                    <p class="text-sm text-slate-400 uppercase tracking-[0.25em]">Detail Pembayaran</p>
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
                            <option value="Kas Bulanan">Kas Bulanan</option>
                            <option value="Kas Kebersihan">Kas Kebersihan</option>
                            <option value="Kas Sampah">Kas Sampah</option>
                            <option value="Kas Kegiatan">Kas Kegiatan</option>
                            <option value="Kas Kesehatan">Kas Kesehatan</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Metode Pembayaran</label>
                        <select x-model="paymentMethod" name="payment_method" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                            <option value="Virtual Account">Virtual Account</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" required>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-300">Catatan Transaksi</label>
                        <textarea name="keterangan" rows="3" class="w-full rounded-3xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-100 outline-none transition focus:border-emerald-400 focus:ring-emerald-500/20" placeholder="Contoh: Iuran lingkungan bulan Mei">{{ old('keterangan') }}</textarea>
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
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm text-slate-400">Kategori Setoran</span>
                            <span class="font-semibold text-white" x-text="transactionCategory"></span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm text-slate-400">Bayar ke</span>
                            <span class="font-semibold text-white" x-text="paymentDestination"></span>
                        </div>
                        <div class="rounded-3xl border border-slate-700 bg-slate-900/90 p-4">
                            <p class="text-sm text-slate-400">Metode</p>
                            <p class="mt-1 font-semibold text-white" x-text="paymentMethod"></p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[32px] border border-slate-800 bg-slate-900/95 p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="mt-1 inline-flex h-3 w-3 rounded-full bg-emerald-400"></span>
                        <div>
                            <p class="text-sm font-semibold text-white">Tampilan Transaksi Realistis</p>
                            <p class="mt-1 text-sm text-slate-400">Meskipun bukan transaksi riil, formulir ini dibuat mirip dengan proses pembayaran digital biasa.</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="rounded-3xl bg-slate-950/90 p-4 border border-slate-700">
                            <p class="text-sm text-slate-400">Catatan</p>
                            <p class="mt-2 text-slate-300">Setelah dikirim, data setoran akan tersimpan sebagai bukti iuran dalam sistem kas RT/RW.</p>
                        </div>
                        <div class="rounded-3xl bg-slate-950/90 p-4 border border-slate-700">
                            <p class="text-sm text-slate-400">Instruksi Bayar</p>
                            <ul class="mt-3 list-disc space-y-2 pl-5 text-slate-300">
                                <li>Pilih metode pembayaran.</li>
                                <li>Lengkapi nominal dan tanggal.</li>
                                <li>Tekan tombol simpan untuk mencatat setoran.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="rounded-3xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-xl shadow-emerald-500/20 transition hover:bg-emerald-400">Simpan Setoran</button>
                    <button type="button" @click="showAddForm=false" class="rounded-3xl border border-slate-700 bg-slate-900 px-5 py-3 text-sm font-semibold text-slate-200">Batal</button>
                </div>
            </div>
        </form>
    </div>

    <section class="space-y-6">
        <div class="rounded-[40px] glass-card border border-white/10 p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-emerald-300">Ringkasan Setoran</p>
                    <h2 class="text-3xl font-bold text-white">Riwayat Setoran Terbaru</h2>
                </div>
                <a href="{{ route('user.kas.index') }}" class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-300 hover:text-white">Lihat semua</a>
            </div>
        </div>

        <div class="overflow-hidden rounded-[40px] border border-white/10 bg-slate-900/80 shadow-2xl shadow-slate-950/30">
            <div class="grid gap-4 p-6 md:grid-cols-[1.2fr_0.8fr]">
                <div class="rounded-[32px] bg-slate-950/90 p-6">
                    <p class="text-sm text-slate-400">Performa Setoran</p>
                    <div class="mt-4 flex items-end gap-4">
                        <div class="h-24 w-full rounded-3xl bg-gradient-to-b from-emerald-500 to-emerald-700"></div>
                        <div class="h-16 w-full rounded-3xl bg-gradient-to-b from-sky-500 to-sky-700"></div>
                        <div class="h-20 w-full rounded-3xl bg-gradient-to-b from-violet-500 to-violet-700"></div>
                    </div>
                </div>
                <div class="rounded-[32px] bg-slate-950/90 p-6">
                    <p class="text-sm text-slate-400">Ringkasan</p>
                    <ul class="mt-6 space-y-4 text-slate-300">
                        <li class="flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
                            Total setoran: <span class="font-semibold text-white">{{ $kasData->count() }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-sky-400"></span>
                            Total uang: <span class="font-semibold text-white">Rp {{ number_format($kasData->sum('setoran'), 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-violet-400"></span>
                            Periode: <span class="font-semibold text-white">{{ date('F Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-[40px] glass-card border border-white/10 p-8 shadow-2xl shadow-slate-950/20">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-emerald-300">Notifikasi</p>
                <h2 class="text-2xl font-bold text-white">Pemberitahuan Terbaru</h2>
            </div>
            <span class="rounded-full bg-emerald-500/15 px-4 py-2 text-sm font-semibold text-emerald-200">Aman</span>
        </div>

        <div class="mt-6 space-y-4">
            <div class="rounded-[32px] bg-slate-950/90 p-5 border border-white/10">
                <p class="text-sm text-slate-400">Selamat! Setoran terakhir Anda sudah dicatat.</p>
                <p class="mt-2 text-sm text-slate-300">Periksa bukti jika ingin mengonfirmasi ke pengurus.</p>
            </div>
            <div class="rounded-[32px] bg-slate-950/90 p-5 border border-white/10">
                <p class="text-sm text-slate-400">Tips Keamanan</p>
                <p class="mt-2 text-sm text-slate-300">Jaga data akun Anda dan laporkan jika terdapat kesalahan transaksi.</p>
            </div>
        </div>
    </section>
</div>
@endsection
