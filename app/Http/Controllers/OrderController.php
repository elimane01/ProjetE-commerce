<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Affiche le formulaire de commande
    public function create()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }
        return view('orders.create', compact('cart'));
    }

    // Enregistre la commande
    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }
        $request->validate([
            'adresse_livraison' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'email' => 'required|email',
            'mode_paiement' => 'required|in:en_ligne,a_la_livraison',
        ]);

        // Si paiement en ligne, sauvegarder les données et rediriger vers le paiement
        if ($request->mode_paiement === 'en_ligne') {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            // Sauvegarder les données de commande en session pour le paiement
            session([
                'pending_order' => [
                    'adresse_livraison' => $request->adresse_livraison,
                    'telephone' => $request->telephone,
                    'email' => $request->email,
                    'mode_paiement' => $request->mode_paiement,
                    'total' => $total,
                ]
            ]);
            
            return redirect()->route('orders.payment');
        }

        // Si paiement à la livraison, valider directement
        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $order = Order::create([
                'user_id' => Auth::id(),
                'adresse_livraison' => $request->adresse_livraison,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'mode_paiement' => $request->mode_paiement,
                'statut' => 'en_attente',
                'total' => $total,
            ]);
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantite' => $item['quantity'],
                    'prix_unitaire' => $item['price'],
                ]);
            }
            DB::commit();
            session()->forget('cart');
            return redirect()->route('orders.confirmation', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la validation de la commande.');
        }
    }

    // Affiche la page de confirmation
    public function confirmation($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('orders.confirmation', compact('order'));
    }

    // Affiche la page de paiement
    public function payment()
    {
        $pendingOrder = session('pending_order');
        if (!$pendingOrder) {
            return redirect()->route('cart.index')->with('error', 'Aucune commande en attente de paiement.');
        }
        return view('orders.payment', compact('pendingOrder'));
    }

    // Traite le paiement
    public function processPayment(Request $request)
    {
        $pendingOrder = session('pending_order');
        if (!$pendingOrder) {
            return redirect()->route('cart.index')->with('error', 'Aucune commande en attente de paiement.');
        }

        $request->validate([
            'card_number' => 'required|string|size:16',
            'card_expiry' => 'required|string|regex:/^\d{2}\/\d{2}$/',
            'card_cvv' => 'required|string|size:3',
            'card_holder' => 'required|string|max:255',
        ]);

        // Simulation du paiement (toujours réussi pour la démo)
        $cart = session('cart', []);
        
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'adresse_livraison' => $pendingOrder['adresse_livraison'],
                'telephone' => $pendingOrder['telephone'],
                'email' => $pendingOrder['email'],
                'mode_paiement' => $pendingOrder['mode_paiement'],
                'statut' => 'validee', // Statut validé car paiement réussi
                'total' => $pendingOrder['total'],
            ]);
            
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantite' => $item['quantity'],
                    'prix_unitaire' => $item['price'],
                ]);
            }
            
            DB::commit();
            session()->forget(['cart', 'pending_order']);
            
            return redirect()->route('orders.confirmation', $order->id)
                           ->with('success', 'Paiement effectué avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors du traitement du paiement.');
        }
    }
}
