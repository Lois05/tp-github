<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Avis;

class AvisSeeder extends Seeder
{
    public function run()
    {
        Avis::factory()->count(50)->create();
    }
}
