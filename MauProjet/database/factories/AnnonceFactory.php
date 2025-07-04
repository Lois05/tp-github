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
        $faker = $this->faker;

        // Sélectionne uniquement un utilisateur qui est aussi propriétaire
        $user = User::whereHas('proprietaire')->inRandomOrder()->first();

        // Sélectionne un bien existant aléatoirement
        $bien = Bien::inRandomOrder()->first();

        return [
            'titre' => $faker->sentence,
            'description' => $faker->paragraph,
            'prix' => $faker->numberBetween(1000, 50000),
            'statut' => $faker->randomElement(['validee', 'en_attente']),
            'localisation' => $faker->city,
            'user_id' => $user?->id, // NULL-safe en cas d'absence de user
            'bien_id' => $bien?->id,
        ];
    }
}
