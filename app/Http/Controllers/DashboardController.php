<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role == 'kapolsek') {
            return redirect()->route('kapolsek.dashboard');
        } elseif ($role == 'petugas_spkt') {
            return redirect()->route('petugas.dashboard');
        } elseif ($role == 'masyarakat') {
            return redirect()->route('masyarakat.dashboard');
        } else {
            Auth::logout();
            return redirect('/login')->with('error', 'Role tidak dikenali.');
        }
    }
}
