<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Informatique', 'description' => 'Ordinateurs, accessoires, etc.'],
            ['name' => 'Téléphones', 'description' => 'Smartphones, accessoires mobiles'],
            ['name' => 'Mode', 'description' => 'Vêtements, chaussures, accessoires'],
            ['name' => 'Maison', 'description' => 'Meubles, déco, électroménager'],
            ['name' => 'Sport', 'description' => 'Articles et équipements sportifs'],
            ['name' => 'Beauté', 'description' => 'Cosmétiques, soins, parfums'],
            ['name' => 'Livres', 'description' => 'Romans, BD, manuels, scolaires'],
            ['name' => 'Jeux vidéo', 'description' => 'Consoles, jeux, accessoires gaming'],
            ['name' => 'Bricolage', 'description' => 'Outils, matériaux, jardinage'],
            ['name' => 'Alimentation', 'description' => 'Épicerie, boissons, produits frais'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
