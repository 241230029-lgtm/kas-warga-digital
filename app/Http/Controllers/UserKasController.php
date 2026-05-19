<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKasController extends Controller
{
    public function __construct()
    {
        $this->middleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'user') {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $kasData = $user->kas()->latest('tanggal')->get();

        return view('user.kas.index', compact('kasData'));
    }

    public function create()
    {
        return view('user.kas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => 'required|string|max:255',
            'setoran' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $destination = $this->resolveDestination($request->input('kategori'));

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->kas()->create(array_merge($request->only(['nama_warga', 'setoran', 'tanggal', 'kategori', 'payment_method', 'keterangan']), ['destination' => $destination]));

        return redirect()->route('user.dashboard')->with('success', 'Setoran kas berhasil ditambahkan.');
    }

    public function edit(Kas $ka)
    {
        $this->authorizeKas($ka);

        $kas = $ka;
        return view('user.kas.edit', compact('kas'));
    }

    public function update(Request $request, Kas $ka)
    {
        $this->authorizeKas($ka);

        $request->validate([
            'nama_warga' => 'required|string|max:255',
            'setoran' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $destination = $this->resolveDestination($request->input('kategori'));

        $ka->update(array_merge($request->only(['nama_warga', 'setoran', 'tanggal', 'kategori', 'payment_method', 'keterangan']), ['destination' => $destination]));

        return redirect()->route('user.dashboard')->with('success', 'Setoran kas berhasil diperbarui.');
    }

    protected function resolveDestination(string $kategori): string
    {
        return match ($kategori) {
            'Kas Kebersihan' => 'Ketua RT',
            'Kas Sampah' => 'Dinas Kebersihan',
            'Kas Kegiatan' => 'Panitia Kegiatan',
            default => 'Bendahara',
        };
    }

    public function destroy(Kas $ka)
    {
        $this->authorizeKas($ka);

        $ka->delete();

        return redirect()->route('user.dashboard')->with('success', 'Setoran kas berhasil dihapus.');
    }

    protected function authorizeKas(Kas $ka): void
    {
        if ($ka->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
