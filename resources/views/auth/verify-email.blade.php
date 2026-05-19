@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-160px)] flex items-center justify-center py-16 px-4">
    <div class="max-w-md w-full bg-white rounded-[40px] shadow-2xl border border-gray-100 p-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Verifikasi Email</h1>
        <p class="text-gray-500 mb-8">Silakan verifikasi alamat email Anda dengan membuka tautan yang dikirimkan ke email Anda.</p>

        @if (session('status') === 'verification-link-sent')
            <div class="mb-6 rounded-3xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-700">
                Tautan verifikasi baru telah dikirimkan ke email Anda.
            </div>
        @endif

        <div class="space-y-6">
            <p class="text-sm text-gray-500">Jika Anda belum menerima email verifikasi, klik tombol di bawah untuk mengirim ulang.</p>

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="w-full bg-emerald-500 text-white rounded-3xl py-4 font-semibold shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition">Kirim Ulang Tautan Verifikasi</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm text-gray-500 underline hover:text-emerald-500">Keluar</button>
            </form>
        </div>
    </div>
</div>
@endsection
