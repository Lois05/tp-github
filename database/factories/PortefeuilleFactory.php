<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Locataire;
use App\Models\Proprietaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortefeuilleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'solde' => $this->faker->numberBetween(5000, 100000),
            'locataire_id' => Locataire::factory(),
            'proprietaire_id' => Proprietaire::factory(),
            'admin_id' => Admin::factory(),
        ];
    }
}
