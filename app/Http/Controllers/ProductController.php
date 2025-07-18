<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Filtrage par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Recherche par mots-clés
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhereHas('category', function($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%") ;
                  });
            });
        }

        // Pagination (12 produits par page)
        $products = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }
}
