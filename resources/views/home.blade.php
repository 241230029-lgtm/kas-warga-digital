@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden">

    <!-- Blur -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-emerald-200 rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-blue-200 rounded-full blur-3xl opacity-20"></div>

    <div class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT -->
            <div>

                <div class="inline-flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                    <i class="fa-solid fa-shield-halved mr-2"></i>
                    Sistem Kas RT/RW Modern
                </div>

                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900">

                    Kelola Kas Warga
                    Lebih
                    <span class="text-emerald-500">
                        Mudah &
                    </span>

                    Transparan
                </h1>

                <p class="mt-8 text-lg text-gray-500 leading-relaxed max-w-xl">
                    Platform digital untuk membantu pengelolaan kas warga,
                    iuran bulanan, laporan keuangan, dan data warga secara
                    modern, cepat, dan efisien.
                </p>

                <div class="flex flex-wrap gap-4 mt-10">

                    <a href="{{ route('login') }}"
                       class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-emerald-200 transition">

                        Masuk Dashboard

                    </a>

                    <button class="border border-gray-300 hover:border-emerald-500 hover:text-emerald-500 px-8 py-4 rounded-2xl font-bold transition">
                        Pelajari Sistem
                    </button>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 p-8">

                    <div class="flex items-center justify-between mb-8">

                        <div>
                            <p class="text-gray-400 text-sm">
                                Total Saldo Kas
                            </p>

                            <h2 class="text-4xl font-extrabold mt-2">
                                Rp 25.500.000
                            </h2>
                        </div>

                        <div class="w-16 h-16 rounded-2xl bg-emerald-500 flex items-center justify-center text-white text-2xl">
                            <i class="fa-solid fa-wallet"></i>
                        </div>

                    </div>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-500">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        Budi Santoso
                                    </h3>

                                    <p class="text-sm text-gray-400">
                                        Iuran Bulanan
                                    </p>
                                </div>

                            </div>

                            <span class="text-emerald-500 font-bold">
                                Lunas
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
