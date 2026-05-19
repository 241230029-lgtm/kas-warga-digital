<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->role, ['user', 'admin'])) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $kasData = $user->kas()->latest('tanggal')->get();

        return view('user.dashboard', compact('kasData'));
    }
}
