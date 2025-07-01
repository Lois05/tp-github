<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proprietaire;

class ProprietaireSeeder extends Seeder
{
    public function run()
    {
        Proprietaire::factory()->count(10)->create();
    }
}
