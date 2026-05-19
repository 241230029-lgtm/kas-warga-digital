<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Warga Digital</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gradient-bg {
            background:
            radial-gradient(circle at top left, rgba(16,185,129,0.15), transparent 30%),
            radial-gradient(circle at bottom right, rgba(59,130,246,0.15), transparent 30%);
        }

    </style>

</head>

<body class="bg-[#fcfcfc] text-gray-800 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="w-full border-b border-gray-100 bg-white/80 backdrop-blur-xl sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center space-x-3">

                <div class="w-11 h-11 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <i class="fa-solid fa-wallet text-lg"></i>
                </div>

                <div>

                    <h1 class="text-xl font-extrabold tracking-tight">
                        KasWarga
                    </h1>

                    <p class="text-xs text-gray-500 -mt-1">
                        Digital Management
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <div class="hidden md:flex items-center space-x-8 font-medium">

                <a href="{{ route('home') }}"
                   class="hover:text-emerald-500 transition duration-300">
                    Beranda
                </a>

                <a href="{{ route('fitur') }}"
                   class="hover:text-emerald-500 transition duration-300">
                    Fitur
                </a>

                <a href="{{ route('tentang') }}"
                   class="hover:text-emerald-500 transition duration-300">
                    Tentang
                </a>

                <a href="{{ route('kontak') }}"
                   class="hover:text-emerald-500 transition duration-300">
                    Kontak
                </a>

            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-2xl font-semibold transition shadow-lg shadow-emerald-200">Login</a>
                    <a href="{{ route('register') }}" class="hidden md:inline-flex bg-white text-emerald-600 px-5 py-2.5 rounded-2xl font-semibold border border-emerald-200 hover:bg-emerald-50 transition">Daftar</a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-emerald-500 transition duration-300">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-2xl font-semibold transition shadow-lg shadow-emerald-200">Logout</button>
                    </form>
                @endguest
            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <main class="flex-1">

        @yield('content')

    </main>

    <!-- FOOTER -->
    @include('partials.footer')

</body>
</html>
