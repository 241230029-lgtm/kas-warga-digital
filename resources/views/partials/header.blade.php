<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('kas.index') }}" class="flex items-center space-x-2 group">
            <div class="bg-blue-600 p-2 rounded-lg group-hover:rotate-12 transition-transform">
                <i class="fa-solid fa-building-columns text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-800">Kas<span class="text-blue-600">Digital</span></span>
        </a>

        <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
            <a href="{{ route('kas.index') }}" class="hover:text-blue-600 transition">Dashboard</a>
            <a href="#" class="hover:text-blue-600 transition">Laporan</a>
            <a href="#" class="hover:text-blue-600 transition font-bold text-blue-600 bg-blue-50 px-4 py-2 rounded-full italic">Admin</a>
        </nav>
    </div>
</header>
