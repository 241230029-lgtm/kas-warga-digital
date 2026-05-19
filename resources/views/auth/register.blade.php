@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-160px)] flex items-center justify-center py-16 px-4">
    <div class="max-w-md w-full bg-white rounded-[40px] shadow-2xl border border-gray-100 p-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Daftar Akun Baru</h1>
        <p class="text-gray-500 mb-8">Daftar untuk mulai mencatat setoran kas warga.</p>

        @if ($errors->any())
            <div class="mb-6 rounded-3xl bg-red-50 border border-red-200 p-4 text-red-700">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-3xl border border-gray-200 px-5 py-4 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-3xl border border-gray-200 px-5 py-4 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Kata Sandi</label>
                <input type="password" name="password" required class="w-full rounded-3xl border border-gray-200 px-5 py-4 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-3xl border border-gray-200 px-5 py-4 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
            </div>

            <button type="submit" class="w-full bg-emerald-500 text-white rounded-3xl py-4 font-semibold shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition">Daftar</button>

            <p class="text-sm text-gray-500 text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Masuk sekarang</a>.</p>
        </form>
    </div>
</div>
@endsection
