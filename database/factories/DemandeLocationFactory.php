<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Bien;
use App\Models\Locataire;
use App\Models\Proprietaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeLocationFactory extends Factory
{
    public function definition() {
    $locataire = Locataire::factory()->create();
    $proprietaire = Proprietaire::factory()->create();
    $bien = Bien::factory()->create(['proprietaire_id' => $proprietaire->id]);
    $annonce = Annonce::factory()->create([
        'user_id' => $proprietaire->user_id,
        'bien_id' => $bien->id,
    ]);
    return [
        'annonce_id' => $annonce->id,
        'bien_id' => $bien->id,
        'locataire_id' => $locataire->id,
        'proprietaire_id' => $proprietaire->id,
        'nom' => $this->faker->name(),
        'telephone' => $this->faker->phoneNumber(),
        'message' => $this->faker->sentence(),
        'date_debut' => now()->addDays(1),
        'date_fin' => now()->addDays(10),
        'statut' => 'en_attente',
    ];
}
}
