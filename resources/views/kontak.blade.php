@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-24">

    <div class="bg-white border border-gray-100 rounded-[3rem] p-12 shadow-sm">

        <h1 class="text-5xl font-extrabold text-gray-900 mb-10 text-center">
            Kontak Kami
        </h1>

        <div class="space-y-6 text-lg">

            <div class="flex items-center gap-4">
                <i class="fa-solid fa-envelope text-emerald-500"></i>
                <span>kaswarga@email.com</span>
            </div>

            <div class="flex items-center gap-4">
                <i class="fa-solid fa-phone text-emerald-500"></i>
                <span>+62 812 3456 7890</span>
            </div>

            <div class="flex items-center gap-4">
                <i class="fa-solid fa-location-dot text-emerald-500"></i>
                <span>Pontianak, Indonesia</span>
            </div>

        </div>

    </div>

</div>

@endsection
