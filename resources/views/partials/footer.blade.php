<footer class="bg-gray-900 text-white mt-24">

    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid md:grid-cols-4 gap-10">

            <!-- Logo -->
            <div>

                <div class="flex items-center space-x-3 mb-6">

                    <div class="w-12 h-12 rounded-2xl bg-emerald-500 flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-wallet"></i>
                    </div>

                    <div>

                        <h2 class="text-2xl font-extrabold">
                            KasWarga
                        </h2>

                        <p class="text-sm text-gray-400">
                            Digital Management
                        </p>

                    </div>

                </div>

                <p class="text-gray-400 leading-relaxed">
                    Platform modern untuk membantu RT/RW dalam mengelola
                    kas warga secara transparan, cepat, dan efisien.
                </p>

            </div>

            <!-- Navigasi -->
            <div>

                <h3 class="font-bold text-lg mb-6">
                    Navigasi
                </h3>

                <ul class="space-y-4 text-gray-400">

                    <li>
                        <a href="/"
                           class="hover:text-emerald-400 transition">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="hover:text-emerald-400 transition">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-emerald-400 transition">
                            Fitur
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Bantuan -->
            <div>

                <h3 class="font-bold text-lg mb-6">
                    Bantuan
                </h3>

                <ul class="space-y-4 text-gray-400">

                    <li>
                        <a href="#"
                           class="hover:text-emerald-400 transition">
                            Tentang Kami
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-emerald-400 transition">
                            Kontak
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-emerald-400 transition">
                            Kebijakan Privasi
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Sosial Media -->
            <div>

                <h3 class="font-bold text-lg mb-6">
                    Sosial Media
                </h3>

                <div class="flex space-x-4">

                    <a href="#"
                       class="w-12 h-12 rounded-2xl bg-gray-800 hover:bg-emerald-500 transition flex items-center justify-center">

                        <i class="fa-brands fa-instagram"></i>

                    </a>

                    <a href="#"
                       class="w-12 h-12 rounded-2xl bg-gray-800 hover:bg-emerald-500 transition flex items-center justify-center">

                        <i class="fa-brands fa-facebook-f"></i>

                    </a>

                    <a href="#"
                       class="w-12 h-12 rounded-2xl bg-gray-800 hover:bg-emerald-500 transition flex items-center justify-center">

                        <i class="fa-brands fa-whatsapp"></i>

                    </a>

                </div>

            </div>

        </div>

        <!-- Bottom -->
        <div class="border-t border-gray-800 mt-14 pt-8 flex flex-col md:flex-row items-center justify-between">

            <p class="text-gray-500 text-sm">
                © {{ date('Y') }} KasWarga Digital. All rights reserved.
            </p>

            <div class="flex items-center gap-6 mt-4 md:mt-0">

                <div class="flex items-center text-sm text-gray-500">

                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>

                    System Online

                </div>

                <div class="text-sm text-gray-500">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </div>

            </div>

        </div>

    </div>

</footer>
