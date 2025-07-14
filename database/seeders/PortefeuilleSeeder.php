<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portefeuille;

class PortefeuilleSeeder extends Seeder
{
    public function run()
    {
        Portefeuille::factory()->count(10)->create();
    }
}

