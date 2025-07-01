<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvisFactory extends Factory
{
    public function definition(): array
    {
        return [
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'user_id' => User::factory(),
            'annonce_id' => \App\Models\Annonce::factory(),
            'signale' => $this->faker->boolean(5),
        ];
    }
}

