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
            'nom' => $this->faker->word,
            'etat' => $this->faker->randomElement(['disponible', 'loué']),
            'description' => $this->faker->paragraph(2),

            'categorie_id' => Categorie::factory(),
        ];
    }
}


