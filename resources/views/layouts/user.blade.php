<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna KasWarga</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(15,23,42,0.92); backdrop-filter: blur(22px); border: 1px solid rgba(148,163,184,0.14); }
        .text-glow { text-shadow: 0 0 18px rgba(16,185,129,0.18); }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <aside class="w-full lg:w-80 shrink-0 border-b border-slate-800/60 bg-slate-950/95 lg:border-r lg:border-b-0 lg:bg-slate-950/90">
            <div class="px-8 py-8 lg:py-10">
                <div class="inline-flex items-center gap-4">
                    <div class="h-14 w-14 rounded-3xl bg-emerald-500 shadow-[0_20px_60px_-30px_rgba(16,185,129,0.9)] flex items-center justify-center text-2xl text-white">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Dashboard</p>
                        <h1 class="text-xl font-semibold text-white">Pengguna KasWarga</h1>
                    </div>
                </div>

                <div class="mt-10 space-y-4">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 rounded-3xl bg-emerald-500/10 px-5 py-4 text-white shadow-lg shadow-emerald-500/10 transition hover:bg-emerald-500/20">
                        <i class="fa-solid fa-house-chimney-user w-5"></i>
                        <span class="font-semibold">Dashboard</span>
                    </a>

                    <a href="{{ route('user.kas.index') }}" class="flex items-center gap-3 rounded-3xl px-5 py-4 text-slate-300 hover:bg-slate-800 transition">
                        <i class="fa-solid fa-wallet w-5"></i>
                        <span class="font-semibold">Riwayat Setoran</span>
                    </a>

                    <a href="{{ route('user.kas.create') }}" class="flex items-center gap-3 rounded-3xl px-5 py-4 text-slate-300 hover:bg-slate-800 transition">
                        <i class="fa-solid fa-plus-circle w-5"></i>
                        <span class="font-semibold">Tambah Setoran</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-3xl px-5 py-4 text-slate-100 hover:bg-slate-800 transition bg-slate-900/80 border border-slate-700">
                            <i class="fa-solid fa-right-from-bracket w-5"></i>
                            <span class="font-semibold">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1">
            <header class="border-b border-slate-800/80 bg-slate-950/60 backdrop-blur-xl px-6 py-5 lg:px-10">
                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm text-slate-400">Selamat datang kembali,</p>
                        <h2 class="text-3xl font-semibold text-white">{{ auth()->user()->name }}</h2>
                    </div>
                    <div class="inline-flex items-center gap-3 rounded-3xl border border-slate-800/80 bg-slate-900/90 px-5 py-3 text-slate-200">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-emerald-500 text-white">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                        <div>
                            <p class="text-sm text-slate-400">Akun pengguna</p>
                            <p class="font-semibold text-white">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="px-6 py-8 lg:px-10">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
