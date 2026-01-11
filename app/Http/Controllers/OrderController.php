<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdatedMail;

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
            // Envoi de l'email de confirmation
            Mail::to($order->email)->send(new OrderConfirmationMail($order));
            DB::commit();
            session()->forget('cart');
            session()->save();
            return redirect()->route('orders.index')->with('success', 'Commande validée avec succès !');
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
            // Envoi de l'email de confirmation
            Mail::to($order->email)->send(new OrderConfirmationMail($order));
            
            DB::commit();
            session()->forget(['cart', 'pending_order']);
            session()->save();
            return redirect()->route('orders.index')->with('success', 'Paiement effectué avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors du traitement du paiement.');
        }
    }

    // Affiche l'historique des commandes du client
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('orderItems.product')
                      ->orderBy('created_at', 'desc')
                      ->get();
        return view('orders.index', compact('orders'));
    }

    // Affiche le détail d'une commande spécifique
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->with('orderItems.product')
                     ->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Télécharge la facture PDF
    public function downloadInvoice($id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->with('orderItems.product')
                     ->findOrFail($id);
        
        // Générer le PDF (pour l'instant, on redirige vers une vue PDF)
        return view('orders.invoice', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,validee,expediee,livree,annulee',
        ]);
        $order = Order::findOrFail($id);
        $order->statut = $request->statut;
        $order->save();
        // Envoi de l'email de notification
        Mail::to($order->email)->send(new OrderStatusUpdatedMail($order, $order->statut));
        return redirect()->route('orders.show', $order->id)->with('success', 'Statut mis à jour et notification envoyée !');
    }
}
