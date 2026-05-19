@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-gray-900">
            Fitur KasWarga
        </h1>

        <p class="text-gray-500 mt-6 text-lg">
            Sistem pengelolaan kas modern untuk RT dan RW.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-500 text-2xl mb-6">
                <i class="fa-solid fa-wallet"></i>
            </div>

            <h2 class="text-2xl font-bold mb-4">
                Manajemen Kas
            </h2>

            <p class="text-gray-500 leading-relaxed">
                Mengelola seluruh pemasukan dan pengeluaran warga secara realtime.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-500 text-2xl mb-6">
                <i class="fa-solid fa-chart-line"></i>
            </div>

            <h2 class="text-2xl font-bold mb-4">
                Statistik Keuangan
            </h2>

            <p class="text-gray-500 leading-relaxed">
                Menampilkan laporan dan grafik kas secara transparan dan mudah dipahami.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-500 text-2xl mb-6">
                <i class="fa-solid fa-users"></i>
            </div>

            <h2 class="text-2xl font-bold mb-4">
                Data Warga
            </h2>

            <p class="text-gray-500 leading-relaxed">
                Menyimpan dan mengatur data warga dengan lebih efisien.
            </p>
        </div>

    </div>

</div>

@endsection
