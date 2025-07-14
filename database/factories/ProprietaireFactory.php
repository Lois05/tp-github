<?php

namespace Database\Factories;

use App\Models\Proprietaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProprietaireFactory extends Factory
{
    protected $model = Proprietaire::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['physique', 'moral']),
            'date_naissance' => $this->faker->optional()->date(),
            'npi' => $this->faker->optional()->numerify('NPI###'),
            'raison_sociale' => $this->faker->optional()->company(),
            'registre_commerce' => $this->faker->optional()->bothify('RC###-###'),
            'representant_legal' => $this->faker->optional()->name(),
        ];
    }
}
