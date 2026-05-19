<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

    public function index(Request $request)
    {
        $kasData = Kas::with('user')->latest('tanggal')->get();
        $usersCount = User::count();

        return view('admin.dashboard', compact('kasData', 'usersCount'));
    }
}
