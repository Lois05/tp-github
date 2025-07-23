<?php

namespace Database\Seeders;

use App\Models\Signalement;
use Illuminate\Database\Seeder;

class SignalementSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 20 signalements aléatoires
        Signalement::factory()->count(20)->create();
    }
}

