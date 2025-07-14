<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DemandeLocation;

class DemandeLocationSeeder extends Seeder
{
    public function run()
    {
        DemandeLocation::factory()->count(15)->create();
    }
}
