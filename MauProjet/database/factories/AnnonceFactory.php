<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Bien;
use App\Models\Proprietaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    protected $model = Annonce::class;

    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'localisation' => $this->faker->city(),
            'prix' => $this->faker->randomFloat(2, 1000, 100000),
            'statut' => $this->faker->randomElement(['en_attente', 'validee', 'rejetee']),
            'bien_id' => Bien::factory(),
            'proprietaire_id' => Proprietaire::factory(),

        ];
    }
}
