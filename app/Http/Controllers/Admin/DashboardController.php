<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

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
            'total_orders' => Order::count(),
            'chiffre_affaires' => Order::all()->sum(function($order) { return $order->calculated_total; }),
            'produit_plus_vendu' => Product::withCount(['orders as ventes' => function($query) { $query->select(\DB::raw('sum(order_product.quantity)')); }])->orderByDesc('ventes')->first(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function statistics()
    {
        $orders = \App\Models\Order::all();
        $paidOrders = $orders->where('payment_status', 'payé');
        $unpaidOrders = $orders->where('payment_status', 'non payé');
        $stats = [
            'total_orders' => $orders->count(),
            'chiffre_affaires' => $orders->sum(function($order) { return $order->calculated_total; }),
            'produit_plus_vendu' => \App\Models\Product::withCount(['orders as ventes' => function($query) { $query->select(\DB::raw('sum(order_product.quantity)')); }])->orderByDesc('ventes')->first(),
            'paid_orders' => $paidOrders->count(),
            'unpaid_orders' => $unpaidOrders->count(),
            'ca_paye' => $paidOrders->sum(function($order) { return $order->calculated_total; }),
            'ca_non_paye' => $unpaidOrders->sum(function($order) { return $order->calculated_total; }),
        ];
        return view('admin.statistics', compact('stats'));
    }
}
