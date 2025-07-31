<?php

namespace Database\Factories;

use App\Models\Bien;
use App\Models\Categorie;
use App\Models\Proprietaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class BienFactory extends Factory
{
    protected $model = Bien::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'categorie_id' => Categorie::factory(),
            'proprietaire_id' => Proprietaire::factory(),
            'etat' => $this->faker->randomElement(['disponible', 'loué']),
        ];
    }
}
