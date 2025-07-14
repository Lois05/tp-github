<?php

namespace Database\Factories;

use App\Models\Locataire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocataireFactory extends Factory
{
    protected $model = Locataire::class;

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
