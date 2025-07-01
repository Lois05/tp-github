<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;

class AnnonceSeeder extends Seeder
{
    public function run()
    {
        Annonce::factory()->count(30)->create();
    }
}
