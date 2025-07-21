<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bien;
use App\Models\Categorie;
use App\Models\Proprietaire;

class BienSeeder extends Seeder
{
    public function run()
    {
        $categories = Categorie::all();
        $proprietaires = Proprietaire::all();

        Bien::factory()->count(20)->make()->each(function ($bien) use ($categories, $proprietaires) {
            $bien->categorie_id = $categories->random()->id;
            $bien->proprietaire_id = $proprietaires->random()->id;
            $bien->save();
        });
    }
}
