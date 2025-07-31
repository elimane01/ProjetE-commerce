<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\OrderStatusChanged;
use App\Notifications\PaymentStatusChanged;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $statuses = ['en attente', 'validée', 'expédiée', 'annulée'];
        $query = Order::with('user')->orderBy('id', 'desc');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->get();
        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'products'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with(['user', 'products'])->findOrFail($id);
        $statuses = ['en attente', 'validée', 'expédiée', 'annulée'];
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $oldPaymentStatus = $order->payment_status;
        
        $validated = $request->validate([
            'status' => 'required|string',
            'payment_method' => 'nullable|string',
            'payment_status' => 'required|string',
        ]);
        
        $order->update($validated);
        
        // Envoyer notification si le statut a changé
        if ($oldStatus !== $order->status) {
            $order->user->notify(new OrderStatusChanged($order, $oldStatus, $order->status));
        }
        
        // Envoyer notification si le statut de paiement a changé
        if ($oldPaymentStatus !== $order->payment_status) {
            $order->user->notify(new PaymentStatusChanged($order, $oldPaymentStatus, $order->payment_status));
        }
        
        return redirect()->route('orders.show', $order)->with('success', 'Statut de la commande mis à jour !');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès !');
    }

    public function downloadInvoice($id)
    {
        $order = Order::with(['user', 'products'])->findOrFail($id);
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('facture_commande_'.$order->id.'.pdf');
    }
} 