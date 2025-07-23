<?php

namespace Database\Factories;

use App\Models\Signalement;
use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SignalementFactory extends Factory
{
    protected $model = Signalement::class;

    public function definition(): array
    {
        $annonce = Annonce::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'annonce_id' => $annonce ? $annonce->id : Annonce::factory(),
            'user_id' => $user ? $user->id : User::factory(),
            'role_signaleur' => $this->faker->randomElement(['proprietaire', 'locataire']),
            'raison' => $this->faker->sentence(8),
            'statut' => 'en_attente',
        ];
    }
}

