<?php


namespace Database\Factories;

use App\Models\DemandeLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_paiement' => $this->faker->date(),
            'montant' => $this->faker->numberBetween(10000, 200000),
            'mode_paiement' => $this->faker->randomElement(['carte', 'mobile_money', 'espèce']),
            'statut' => $this->faker->randomElement(['en_attente', 'réussi', 'échoué']),
            'type_paiement' => $this->faker->randomElement(['location', 'caution']),
            'demande_location_id' => DemandeLocation::factory(),
        ];
    }
}
