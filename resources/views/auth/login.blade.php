@extends('layouts.guest')

@section('content')
<div x-data="{ showLogin:false, role:'', open(role){ this.role = role; this.showLogin = true; }, close(){ this.showLogin = false; } }" class="min-h-screen bg-slate-950 text-slate-100">
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800"></div>
        <div class="pointer-events-none absolute left-1/2 top-0 h-72 w-72 -translate-x-1/2 rounded-full bg-emerald-500/20 blur-3xl"></div>
        <div class="pointer-events-none absolute right-0 top-24 h-72 w-72 rounded-full bg-sky-500/20 blur-3xl"></div>

        <header class="relative z-10 border-b border-slate-800 bg-slate-950/95">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-emerald-400">KasWarga</p>
                    <h1 class="mt-3 text-3xl font-bold text-white sm:text-4xl">Sistem Kas RT/RW Digital</h1>
                </div>
                <nav class="flex items-center gap-6 text-sm text-slate-300">
                    <a href="#fitur" class="hover:text-white">Fitur</a>
                    <a href="#statistik" class="hover:text-white">Statistik</a>
                    <a href="#login" class="hover:text-white">Login</a>
                </nav>
            </div>
        </header>

        <main class="relative z-10 mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <section class="rounded-[40px] border border-slate-800 bg-slate-900/90 p-10 shadow-2xl shadow-slate-950/40">
                    <h2 class="mt-6 text-5xl font-bold text-white">Selamat datang di Kas Warga Digital</h2>
                    <p class="mt-6 max-w-2xl text-slate-300 leading-8">Kelola iuran RT/RW dengan tampilan gelap yang rapi, kontras tinggi, dan navigasi langsung dari halaman login. Klik Admin atau Pengguna untuk membuka modal login tanpa berpindah halaman.</p>

                    <div class="mt-10 grid gap-4 sm:grid-cols-2">
                        <button @click="open('admin')" class="rounded-3xl bg-emerald-500 px-6 py-4 text-base font-semibold text-slate-950 shadow-xl shadow-emerald-500/25 transition hover:bg-emerald-400">Masuk Admin</button>
                        <button @click="open('user')" class="rounded-3xl border border-slate-700 bg-slate-800 px-6 py-4 text-base font-semibold text-slate-100 hover:bg-slate-700 transition">Masuk Pengguna</button>
                    </div>

                    <div id="fitur" class="mt-14 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[30px] border border-slate-800 bg-slate-950/90 p-6">
                            <p class="text-sm uppercase tracking-[0.28em] text-emerald-300">Fitur</p>
                            <h3 class="mt-4 text-2xl font-bold text-white">Akses cepat</h3>
                            <p class="mt-3 text-slate-400">Login modal langsung dari halaman landing, tanpa perpindahan halaman yang memecah fokus.</p>
                        </div>
                        <div class="rounded-[30px] border border-slate-800 bg-slate-950/90 p-6">
                            <p class="text-sm uppercase tracking-[0.28em] text-emerald-300">Fitur</p>
                            <h3 class="mt-4 text-2xl font-bold text-white">Tampilan elegan</h3>
                            <p class="mt-3 text-slate-400">Tema warna gelap yang nyaman, modern, dan mudah dibaca di malam hari.</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-[40px] border border-slate-800 bg-slate-950/95 p-10 shadow-2xl shadow-slate-950/40">
                    <p class="text-sm uppercase tracking-[0.32em] text-slate-400">Statistik Ringkas</p>
                    <div class="mt-8 space-y-6">
                        <div class="rounded-[32px] bg-slate-900/95 p-6 border border-slate-800">
                            <p class="text-sm text-slate-400">Total Kas</p>
                            <p class="mt-4 text-4xl font-semibold text-white">Rp {{ number_format($totalSetoran ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-[32px] bg-slate-900/95 p-6 border border-slate-800">
                            <p class="text-sm text-slate-400">Jumlah Transaksi</p>
                            <p class="mt-4 text-4xl font-semibold text-white">{{ optional($recentKas)->count() ?? 0 }}</p>
                        </div>
                        <div class="rounded-[32px] bg-slate-900/95 p-6 border border-slate-800">
                            <p class="text-sm text-slate-400">Status Sistem</p>
                            <p class="mt-4 text-4xl font-semibold text-white">Stabil & Siap Pakai</p>
                        </div>
                    </div>
                </section>
            </div>

            <section id="statistik" class="mt-16 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[30px] border border-slate-800 bg-slate-900/95 p-7 shadow-sm">
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Total Kas</p>
                    <p class="mt-4 text-3xl font-semibold text-white">Rp {{ number_format($totalSetoran ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-[30px] border border-slate-800 bg-slate-900/95 p-7 shadow-sm">
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Transaksi</p>
                    <p class="mt-4 text-3xl font-semibold text-white">{{ optional($recentKas)->count() ?? 0 }}</p>
                </div>
                <div class="rounded-[30px] border border-slate-800 bg-slate-900/95 p-7 shadow-sm">
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Interaksi</p>
                    <p class="mt-4 text-3xl font-semibold text-white">Langsung dan intuitif</p>
                </div>
            </section>
        </main>

        <footer class="relative z-10 border-t border-slate-800 bg-slate-950/95">
            <div class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
                <p class="text-sm text-slate-500">Kas Warga Digital — tema gelap yang tetap fokus ke kenyamanan baca dan antarmuka.</p>
            </div>
        </footer>
    </div>

    <div x-show="showLogin" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="close()" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div class="relative z-50 w-full max-w-md rounded-[32px] border border-slate-700 bg-slate-950/95 p-8 shadow-2xl shadow-black/40">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-emerald-400">Login</p>
                    <h2 class="mt-2 text-3xl font-bold text-white">Masuk sebagai <span x-text="role"></span></h2>
                </div>
                <button @click="close()" class="rounded-full border border-slate-700 bg-slate-900 px-3 py-3 text-slate-300 hover:bg-slate-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                @csrf
                <input type="hidden" id="login-role" name="role" :value="role">

                <div>
                    <label class="block text-sm font-semibold text-slate-300">Kata Sandi</label>
                    <input type="password" name="password" required class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-4 text-white outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="flex items-center justify-between text-sm text-slate-400">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded border-slate-600 bg-slate-900 text-emerald-500 focus:ring-emerald-500">
                        Ingat saya
                    </label>
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-400 hover:text-emerald-300">Daftar</a>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" @click="close()" class="rounded-3xl border border-slate-700 bg-slate-900 px-5 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800">Batal</button>
                    <button type="submit" class="rounded-3xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-xl shadow-emerald-500/25 hover:bg-emerald-400">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
