<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\Bien;

class AnnonceSeeder extends Seeder
{
    public function run()
    {
        // Générer 20 annonces avec Bien complet relié
        \App\Models\Annonce::factory()
            ->count(20)
            ->make()
            ->each(function ($annonce) {
                // Créer un Bien complet pour chaque annonce
                $bien = Bien::factory()->create();

                $annonce->bien_id = $bien->id;
                $annonce->user_id = $bien->proprietaire->user_id; // Lier au même user
                $annonce->save();
            });
    }
}
