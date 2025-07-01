<?php

namespace Database\Factories;

use App\Models\Bien;
use App\Models\Locataire;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeLocationFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $end = (clone $start)->modify('+'.rand(2, 10).' days');

        return [
            'date_debut' => $start->format('Y-m-d'),
            'date_fin' => $end->format('Y-m-d'),
            'statut' => $this->faker->randomElement(['en_attente', 'acceptée', 'refusée']),
            'bien_id' => Bien::factory(),
            'locataire_id' => Locataire::factory(),
        ];
    }
}
