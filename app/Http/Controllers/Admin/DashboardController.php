<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Vérification admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Accès non autorisé');
        }

        // Statistiques de base
        $stats = [
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'regular_users' => User::where('is_admin', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
