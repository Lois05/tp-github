<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paiement;
use App\Models\DemandeLocation;

class PaiementSeeder extends Seeder
{
    public function run()
    {
        DemandeLocation::all()->each(function ($demande) {
            Paiement::factory()->count(1)->create([
                'demande_location_id' => $demande->id,
            ]);
        });
    }
}
