<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\User;
use App\Models\Proprietaire;

class AnnonceSeeder extends Seeder
{
    public function run()
    {
        // Crée un seul user + propriétaire commun pour les Biens
        $user = User::factory()->create();
        $proprietaire = Proprietaire::factory()->create(['user_id' => $user->id]);

        foreach (range(1, 20) as $i) {
            $bien = Bien::factory()->create([
                'proprietaire_id' => $proprietaire->id,
            ]);

            Annonce::factory()->create([
                'bien_id' => $bien->id,
                'user_id' => $user->id, // même user que proprio
            ]);
        }
    }
}

