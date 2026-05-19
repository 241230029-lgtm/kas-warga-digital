<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    public function __construct()
    {
        $this->middleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $kasData = Kas::all();
        return view('kas.index', compact('kasData'));
    }

    public function create()
    {
        return view('kas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => 'required|string|max:255',
            'setoran'    => 'required|numeric|min:0',
            'tanggal'    => 'required|date',
            'kategori' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['nama_warga', 'setoran', 'tanggal', 'kategori', 'payment_method', 'keterangan', 'destination', 'user_id']);
        $data['destination'] = trim($data['destination'] ?? '') ?: $this->resolveDestination($data['kategori'] ?? 'Kas Bulanan');

        Kas::create($data);

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan!');
    }

    public function edit(Kas $ka) // Laravel otomatis mencari ID jika nama variabel $ka cocok dengan route
    {
        return view('kas.edit', compact('ka'));
    }

    public function update(Request $request, Kas $ka)
    {
        $request->validate([
            'nama_warga' => 'required|string|max:255',
            'setoran'    => 'required|numeric|min:0',
            'tanggal'    => 'required|date',
            'kategori' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['nama_warga', 'setoran', 'tanggal', 'kategori', 'payment_method', 'keterangan', 'destination']);
        $data['destination'] = trim($data['destination'] ?? '') ?: $this->resolveDestination($data['kategori'] ?? 'Kas Bulanan');

        if ($request->has('user_id')) {
            $data['user_id'] = $request->input('user_id');
        }

        $ka->update($data);

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil diperbarui!');
    }

    protected function resolveDestination(?string $kategori): string
    {
        return match ($kategori) {
            'Kas Kebersihan' => 'Ketua RT',
            'Kas Sampah' => 'Dinas Kebersihan',
            'Kas Kegiatan' => 'Panitia Kegiatan',
            'Kas Kesehatan' => 'Dinas Kesehatan',
            default => 'Bendahara',
        };
    }

    public function destroy(Kas $ka)
    {
        $ka->delete();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil dihapus!');
    }
}
