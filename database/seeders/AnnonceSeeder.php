<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\User;

class AnnonceSeeder extends Seeder
{
    public function run()
    {
        if (User::whereHas('proprietaire')->exists() && Bien::exists()) {
    Annonce::factory()->count(30)->create();
}

    }
}
