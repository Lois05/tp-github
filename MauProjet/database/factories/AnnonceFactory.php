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
            'prix' => $this->faker->numberBetween(5000, 100000),
            'statut' => $this->faker->randomElement(['validee', 'en_attente']),
            'image' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/800/600',
            'user_id' => User::factory(), // Si tu veux forcer plus bas, ça sera écrasé.
            'bien_id' => Bien::factory(), // Idem
        ];
    }
}
