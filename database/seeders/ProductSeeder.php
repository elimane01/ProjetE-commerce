<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // On vide la table produits
        \App\Models\Product::truncate();

        // On supprime tous les doublons (sécurité supplémentaire)
        \App\Models\Product::whereIn('name', 
            \App\Models\Product::select('name')
                ->groupBy('name')
                ->havingRaw('count(*) > 1')
                ->pluck('name')
        )->delete();

        $products = [
            // Informatique
            [
                'name' => 'Ordinateur portable HP',
                'description' => 'PC portable performant pour le travail et les loisirs.',
                'price' => 350000,
                'image' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&w=600', // Laptop HP
                'stock' => 10,
                'category_id' => Category::where('name', 'Informatique')->first()->id,
            ],
            [
                'name' => 'Souris Logitech',
                'description' => 'Souris sans fil ergonomique.',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=600&q=80', // Souris
                'stock' => 25,
                'category_id' => Category::where('name', 'Informatique')->first()->id,
            ],
            // Téléphones
            [
                'name' => 'Smartphone Samsung',
                'description' => 'Téléphone Android dernière génération.',
                'price' => 200000,
                'image' => 'https://images.pexels.com/photos/1092671/pexels-photo-1092671.jpeg?auto=compress&w=600', // Samsung
                'stock' => 15,
                'category_id' => Category::where('name', 'Téléphones')->first()->id,
            ],
            [
                'name' => 'iPhone 13',
                'description' => 'Apple iPhone 13, 128Go, 5G.',
                'price' => 600000,
                'image' => 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&w=600', // iPhone 13
                'stock' => 8,
                'category_id' => Category::where('name', 'Téléphones')->first()->id,
            ],
            // Mode
            [
                'name' => 'T-shirt homme',
                'description' => 'T-shirt 100% coton, confortable et tendance.',
                'price' => 5000,
                'image' => 'https://images.pexels.com/photos/2983464/pexels-photo-2983464.jpeg?auto=compress&w=600', // T-shirt homme
                'stock' => 50,
                'category_id' => Category::where('name', 'Mode')->first()->id,
            ],
            [
                'name' => 'Robe d’été',
                'description' => 'Robe légère pour femme, idéale pour l’été.',
                'price' => 15000,
                'image' => 'https://images.pexels.com/photos/1488463/pexels-photo-1488463.jpeg?auto=compress&w=600', // Robe été
                'stock' => 20,
                'category_id' => Category::where('name', 'Mode')->first()->id,
            ],
            // Maison
            [
                'name' => 'Chaise de bureau',
                'description' => 'Chaise ergonomique pour le bureau ou la maison.',
                'price' => 25000,
                'image' => 'https://images.pexels.com/photos/776656/pexels-photo-776656.jpeg?auto=compress&w=600', // Chaise bureau
                'stock' => 20,
                'category_id' => Category::where('name', 'Maison')->first()->id,
            ],
            [
                'name' => 'Lampe LED',
                'description' => 'Lampe de chevet LED, basse consommation.',
                'price' => 7000,
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=600&q=80', // Lampe LED
                'stock' => 30,
                'category_id' => Category::where('name', 'Maison')->first()->id,
            ],
            // Sport
            [
                'name' => 'Ballon de foot',
                'description' => 'Ballon de football taille 5, idéal pour l’entraînement.',
                'price' => 8000,
                'image' => 'https://images.pexels.com/photos/399187/pexels-photo-399187.jpeg?auto=compress&w=600', // Ballon foot
                'stock' => 30,
                'category_id' => Category::where('name', 'Sport')->first()->id,
            ],
            [
                'name' => 'Raquette de tennis',
                'description' => 'Raquette légère pour débutant ou confirmé.',
                'price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=600&q=80', // Raquette tennis
                'stock' => 12,
                'category_id' => Category::where('name', 'Sport')->first()->id,
            ],
            // Beauté
            [
                'name' => 'Crème hydratante',
                'description' => 'Crème visage pour tous types de peaux.',
                'price' => 9000,
                'image' => 'https://images.pexels.com/photos/3738341/pexels-photo-3738341.jpeg?auto=compress&w=600', // Crème hydratante
                'stock' => 40,
                'category_id' => Category::where('name', 'Beauté')->first()->id,
            ],
            [
                'name' => 'Parfum femme',
                'description' => 'Eau de parfum florale, 50ml.',
                'price' => 25000,
                'image' => 'https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&w=600', // Parfum femme
                'stock' => 18,
                'category_id' => Category::where('name', 'Beauté')->first()->id,
            ],
            // Livres
            [
                'name' => 'Roman policier',
                'description' => 'Un thriller captivant à lire cet été.',
                'price' => 3500,
                'image' => 'https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg?auto=compress&w=600', // Roman policier
                'stock' => 60,
                'category_id' => Category::where('name', 'Livres')->first()->id,
            ],
            [
                'name' => 'Bande dessinée',
                'description' => 'BD humoristique pour petits et grands.',
                'price' => 4000,
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80', // Bande dessinée
                'stock' => 35,
                'category_id' => Category::where('name', 'Livres')->first()->id,
            ],
            // Jeux vidéo
            [
                'name' => 'Console PlayBox',
                'description' => 'Console de jeux nouvelle génération.',
                'price' => 350000,
                'image' => 'https://images.pexels.com/photos/845255/pexels-photo-845255.jpeg?auto=compress&w=600', // Console jeux
                'stock' => 7,
                'category_id' => Category::where('name', 'Jeux vidéo')->first()->id,
            ],
            [
                'name' => 'Manette sans fil',
                'description' => 'Manette compatible PlayBox et PC.',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=600&q=80', // Manette
                'stock' => 22,
                'category_id' => Category::where('name', 'Jeux vidéo')->first()->id,
            ],
            // Bricolage
            [
                'name' => 'Perceuse électrique',
                'description' => 'Perceuse sans fil, batterie longue durée.',
                'price' => 40000,
                'image' => 'https://images.pexels.com/photos/209235/pexels-photo-209235.jpeg?auto=compress&w=600', // Perceuse
                'stock' => 10,
                'category_id' => Category::where('name', 'Bricolage')->first()->id,
            ],
            [
                'name' => 'Boîte à outils',
                'description' => 'Kit complet pour tous vos travaux.',
                'price' => 15000,
                'image' => 'https://images.pexels.com/photos/416405/pexels-photo-416405.jpeg?auto=compress&w=600', // Boîte à outils
                'stock' => 15,
                'category_id' => Category::where('name', 'Bricolage')->first()->id,
            ],
            // Alimentation
            [
                'name' => 'Café moulu',
                'description' => 'Café 100% arabica, paquet de 250g.',
                'price' => 2500,
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80', // Café moulu
                'stock' => 80,
                'category_id' => Category::where('name', 'Alimentation')->first()->id,
            ],
            [
                'name' => 'Jus d’orange',
                'description' => 'Bouteille 1L, pur jus sans sucre ajouté.',
                'price' => 1800,
                'image' => 'https://images.pexels.com/photos/96974/pexels-photo-96974.jpeg?auto=compress&w=600', // Jus d'orange
                'stock' => 50,
                'category_id' => Category::where('name', 'Alimentation')->first()->id,
            ],
        ];
        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
} 