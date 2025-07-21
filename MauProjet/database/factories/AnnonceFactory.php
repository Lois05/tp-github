<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    protected $model = Annonce::class;

    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'localisation' => $this->faker->city,
            'prix' => $this->faker->numberBetween(1000, 50000),
            'statut' => $this->faker->randomElement(['validee', 'en_attente']),
            'user_id' => User::factory(),
            'bien_id' => Bien::factory(), // ✅ Crée automatiquement un Bien lié
        ];
    }
}
