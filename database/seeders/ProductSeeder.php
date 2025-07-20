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
                'description_longue' => "Ordinateur portable HP avec écran 15,6'' Full HD, processeur Intel Core i5, 8 Go RAM, SSD 512 Go.\n\nCaractéristiques :\n- Clavier rétroéclairé\n- Windows 11\n- Autonomie jusqu'à 10h\n- Idéal pour le travail, les études et le multimédia.",
                'price' => 350000,
                'image' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&w=600',
                'stock' => 10,
                'category_id' => Category::where('name', 'Informatique')->first()->id,
            ],
            [
                'name' => 'Souris Logitech',
                'description' => 'Souris sans fil ergonomique.',
                'description_longue' => "Souris sans fil Logitech, prise en main confortable, capteur optique haute précision.\n\nCaractéristiques :\n- Connexion sans fil 2,4 GHz\n- Autonomie 12 mois\n- Compatible Windows/Mac\n- Idéale pour le bureau et la maison.",
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=600&q=80',
                'stock' => 25,
                'category_id' => Category::where('name', 'Informatique')->first()->id,
            ],
            // Téléphones
            [
                'name' => 'Smartphone Samsung',
                'description' => 'Téléphone Android dernière génération.',
                'description_longue' => "Smartphone Samsung avec écran AMOLED 6,5'', 128 Go de stockage, double SIM, batterie 5000 mAh.\n\nCaractéristiques :\n- Appareil photo 64 MP\n- Recharge rapide\n- Android 13\n- Idéal pour photo, jeux, productivité.",
                'price' => 200000,
                'image' => 'https://images.pexels.com/photos/1092671/pexels-photo-1092671.jpeg?auto=compress&w=600',
                'stock' => 15,
                'category_id' => Category::where('name', 'Téléphones')->first()->id,
            ],
            [
                'name' => 'iPhone 13',
                'description' => 'Apple iPhone 13, 128Go, 5G.',
                'description_longue' => "iPhone 13 avec écran Super Retina XDR 6,1'', puce A15 Bionic, 128 Go, 5G.\n\nCaractéristiques :\n- Double appareil photo 12 MP\n- Face ID\n- iOS 16\n- Parfait pour la photo, la vidéo et la performance.",
                'price' => 600000,
                'image' => 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&w=600',
                'stock' => 8,
                'category_id' => Category::where('name', 'Téléphones')->first()->id,
            ],
            // Mode
            [
                'name' => 'T-shirt homme',
                'description' => 'T-shirt 100% coton, confortable et tendance.',
                'description_longue' => "T-shirt pour homme, 100% coton, coupe moderne, lavable en machine.\n\nCaractéristiques :\n- Disponible en plusieurs tailles et couleurs\n- Col rond\n- Idéal pour un look décontracté au quotidien.",
                'price' => 5000,
                'image' => 'https://images.pexels.com/photos/2983464/pexels-photo-2983464.jpeg?auto=compress&w=600',
                'stock' => 50,
                'category_id' => Category::where('name', 'Mode')->first()->id,
            ],
            [
                'name' => 'Robe d’été',
                'description' => 'Robe légère pour femme, idéale pour l’été.',
                'description_longue' => "Robe d'été pour femme, tissu léger et respirant, coupe élégante.\n\nCaractéristiques :\n- Bretelles réglables\n- Motifs fleuris\n- Parfaite pour les journées chaudes et les vacances.",
                'price' => 15000,
                'image' => 'https://images.pexels.com/photos/1488463/pexels-photo-1488463.jpeg?auto=compress&w=600',
                'stock' => 20,
                'category_id' => Category::where('name', 'Mode')->first()->id,
            ],
            // Maison
            [
                'name' => 'Chaise de bureau',
                'description' => 'Chaise ergonomique pour le bureau ou la maison.',
                'description_longue' => "Chaise de bureau ergonomique, dossier réglable, assise rembourrée, roulettes silencieuses.\n\nCaractéristiques :\n- Hauteur ajustable\n- Support lombaire\n- Idéale pour le télétravail ou le gaming.",
                'price' => 25000,
                'image' => 'https://images.pexels.com/photos/776656/pexels-photo-776656.jpeg?auto=compress&w=600',
                'stock' => 20,
                'category_id' => Category::where('name', 'Maison')->first()->id,
            ],
            [
                'name' => 'Lampe LED',
                'description' => 'Lampe de chevet LED, basse consommation.',
                'description_longue' => "Lampe LED de chevet, lumière douce, faible consommation d'énergie, design moderne.\n\nCaractéristiques :\n- Interrupteur tactile\n- 3 niveaux d'intensité\n- Parfaite pour la lecture ou la déco.",
                'price' => 7000,
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=600&q=80',
                'stock' => 30,
                'category_id' => Category::where('name', 'Maison')->first()->id,
            ],
            // Sport
            [
                'name' => 'Ballon de foot',
                'description' => 'Ballon de football taille 5, idéal pour l’entraînement.',
                'description_longue' => "Ballon de football taille 5, revêtement résistant, adapté à tous les terrains.\n\nCaractéristiques :\n- Bonne prise en main\n- Idéal pour l'entraînement ou les matchs\n- Convient aux enfants et adultes.",
                'price' => 8000,
                'image' => 'https://images.pexels.com/photos/399187/pexels-photo-399187.jpeg?auto=compress&w=600',
                'stock' => 30,
                'category_id' => Category::where('name', 'Sport')->first()->id,
            ],
            [
                'name' => 'Raquette de tennis',
                'description' => 'Raquette légère pour débutant ou confirmé.',
                'description_longue' => "Raquette de tennis légère, cadre en aluminium, grip antidérapant.\n\nCaractéristiques :\n- Bonne maniabilité\n- Adaptée à tous niveaux\n- Idéale pour l'entraînement ou la compétition.",
                'price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=600&q=80',
                'stock' => 12,
                'category_id' => Category::where('name', 'Sport')->first()->id,
            ],
            // Beauté
            [
                'name' => 'Crème hydratante',
                'description' => 'Crème visage pour tous types de peaux.',
                'description_longue' => "Crème hydratante visage, texture légère, absorption rapide, sans parabènes.\n\nCaractéristiques :\n- Convient à tous types de peaux\n- Utilisation matin et soir\n- Laisse la peau douce et éclatante.",
                'price' => 9000,
                'image' => 'https://images.pexels.com/photos/3738341/pexels-photo-3738341.jpeg?auto=compress&w=600',
                'stock' => 40,
                'category_id' => Category::where('name', 'Beauté')->first()->id,
            ],
            [
                'name' => 'Parfum femme',
                'description' => 'Eau de parfum florale, 50ml.',
                'description_longue' => "Eau de parfum pour femme, notes florales et fruitées, tenue longue durée.\n\nCaractéristiques :\n- Flacon 50ml\n- Idéal pour offrir ou se faire plaisir\n- Parfum élégant et raffiné.",
                'price' => 25000,
                'image' => 'https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&w=600',
                'stock' => 18,
                'category_id' => Category::where('name', 'Beauté')->first()->id,
            ],
            // Livres
            [
                'name' => 'Roman policier',
                'description' => 'Un thriller captivant à lire cet été.',
                'description_longue' => "Roman policier palpitant, suspense garanti, rebondissements inattendus.\n\nCaractéristiques :\n- 350 pages\n- Format poche\n- Idéal pour les amateurs de mystère.",
                'price' => 3500,
                'image' => 'https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg?auto=compress&w=600',
                'stock' => 60,
                'category_id' => Category::where('name', 'Livres')->first()->id,
            ],
            [
                'name' => 'Bande dessinée',
                'description' => 'BD humoristique pour petits et grands.',
                'description_longue' => "Bande dessinée pleine d'humour, dessins colorés, histoires courtes et amusantes.\n\nCaractéristiques :\n- 48 pages\n- Couverture souple\n- Pour toute la famille.",
                'price' => 4000,
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
                'stock' => 35,
                'category_id' => Category::where('name', 'Livres')->first()->id,
            ],
            // Jeux vidéo
            [
                'name' => 'Console PlayBox',
                'description' => 'Console de jeux nouvelle génération.',
                'description_longue' => "Console PlayBox, graphismes 4K, disque dur 1 To, manette sans fil incluse.\n\nCaractéristiques :\n- Compatible VR\n- Plus de 1000 jeux disponibles\n- Idéale pour toute la famille.",
                'price' => 350000,
                'image' => 'https://images.pexels.com/photos/845255/pexels-photo-845255.jpeg?auto=compress&w=600',
                'stock' => 7,
                'category_id' => Category::where('name', 'Jeux vidéo')->first()->id,
            ],
            [
                'name' => 'Manette sans fil',
                'description' => 'Manette compatible PlayBox et PC.',
                'description_longue' => "Manette de jeu sans fil, ergonomique, autonomie 20h, compatible PlayBox et PC.\n\nCaractéristiques :\n- Vibrations intégrées\n- Portée 10m\n- Idéale pour le gaming intensif.",
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=600&q=80',
                'stock' => 22,
                'category_id' => Category::where('name', 'Jeux vidéo')->first()->id,
            ],
            // Bricolage
            [
                'name' => 'Perceuse électrique',
                'description' => 'Perceuse sans fil, batterie longue durée.',
                'description_longue' => "Perceuse électrique sans fil, batterie lithium 18V, 2 vitesses, livrée avec accessoires.\n\nCaractéristiques :\n- Autonomie 2h\n- Mandrin auto-serrant\n- Idéale pour tous travaux de bricolage.",
                'price' => 40000,
                'image' => 'https://images.pexels.com/photos/209235/pexels-photo-209235.jpeg?auto=compress&w=600',
                'stock' => 10,
                'category_id' => Category::where('name', 'Bricolage')->first()->id,
            ],
            [
                'name' => 'Boîte à outils',
                'description' => 'Kit complet pour tous vos travaux.',
                'description_longue' => "Boîte à outils complète, 50 pièces, tournevis, clés, marteau, pinces.\n\nCaractéristiques :\n- Rangement pratique\n- Outils en acier trempé\n- Parfait pour la maison et le bricolage.",
                'price' => 15000,
                'image' => 'https://images.pexels.com/photos/416405/pexels-photo-416405.jpeg?auto=compress&w=600',
                'stock' => 15,
                'category_id' => Category::where('name', 'Bricolage')->first()->id,
            ],
            // Alimentation
            [
                'name' => 'Café moulu',
                'description' => 'Café 100% arabica, paquet de 250g.',
                'description_longue' => "Café moulu 100% arabica, arôme intense, torréfaction artisanale.\n\nCaractéristiques :\n- Paquet de 250g\n- Idéal pour cafetière filtre ou expresso\n- Parfait pour bien démarrer la journée.",
                'price' => 2500,
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80',
                'stock' => 80,
                'category_id' => Category::where('name', 'Alimentation')->first()->id,
            ],
            [
                'name' => 'Jus d’orange',
                'description' => 'Bouteille 1L, pur jus sans sucre ajouté.',
                'description_longue' => "Jus d'orange 100% pur jus, sans sucre ajouté, riche en vitamine C.\n\nCaractéristiques :\n- Bouteille 1L\n- Goût frais et naturel\n- Idéal pour le petit-déjeuner.",
                'price' => 1800,
                'image' => 'https://images.pexels.com/photos/96974/pexels-photo-96974.jpeg?auto=compress&w=600',
                'stock' => 50,
                'category_id' => Category::where('name', 'Alimentation')->first()->id,
            ],
        ];
        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
} 