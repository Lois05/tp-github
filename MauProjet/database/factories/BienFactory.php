<?php

namespace Database\Factories;

use App\Models\Bien;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class BienFactory extends Factory
{
    protected $model = Bien::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'categorie_id' => Categorie::factory(),
            'etat' => $this->faker->randomElement(['disponible', 'loué']),
        ];
    }
}


