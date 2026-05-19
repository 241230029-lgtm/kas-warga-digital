<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin KasWarga</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: rgba(148,163,184,.4);
            border-radius: 9999px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="min-h-screen flex overflow-hidden">
        <aside class="hidden lg:flex lg:w-80 flex-col bg-slate-950 text-slate-100 shadow-xl">
            <div class="px-8 py-10 border-b border-slate-800 bg-slate-950/95">
                <div class="inline-flex items-center gap-3">
                    <div class="w-12 h-12 rounded-3xl bg-emerald-500 flex items-center justify-center text-white text-xl shadow-lg shadow-emerald-500/20">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-400">KasWarga</p>
                        <h1 class="text-xl font-semibold text-white">Admin Panel</h1>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-6 py-8 space-y-3 overflow-y-auto scrollbar-thin">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-4 rounded-3xl px-5 py-4 bg-emerald-500 text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-400">
                    <i class="fa-solid fa-chart-line w-5"></i>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="{{ route('kas.index') }}" class="group flex items-center gap-4 rounded-3xl px-5 py-4 text-slate-200 hover:bg-slate-800 transition">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="font-semibold">Kelola Kas</span>
                </a>
            </nav>

            <div class="px-6 py-8 border-t border-slate-800">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Quick access</p>
                <div class="mt-4 space-y-3">
                    <a href="{{ route('kas.create') }}" class="block rounded-3xl bg-emerald-500 px-5 py-4 text-center text-sm font-semibold text-white hover:bg-emerald-400 transition">Tambah Transaksi</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-block w-full">
                        @csrf
                        <button type="submit" class="w-full rounded-3xl border border-slate-800 bg-slate-900 px-5 py-4 text-sm font-semibold text-slate-100 hover:bg-slate-800 transition">Keluar</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 min-h-screen overflow-y-auto">
            <header class="sticky top-0 z-20 bg-slate-950/95 backdrop-blur-sm border-b border-slate-800 px-6 py-4 lg:px-10">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm text-slate-400">Selamat datang kembali,</p>
                        <h2 class="text-2xl font-semibold text-white">{{ auth()->user()->name }}</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden md:flex items-center gap-3 rounded-3xl border border-slate-800 bg-slate-900/60 px-4 py-3">
                            <i class="fa-solid fa-bell text-slate-300"></i>
                            <span class="text-sm text-slate-300">Admin</span>
                        </div>
                        <div class="inline-flex items-center rounded-3xl border border-slate-800 bg-slate-900/60 px-4 py-3 text-slate-100 shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=10b981&color=fff&rounded=true" alt="Avatar" class="h-9 w-9 rounded-full">
                            <span class="ml-3 text-sm font-semibold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="px-6 py-8 lg:px-10">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
