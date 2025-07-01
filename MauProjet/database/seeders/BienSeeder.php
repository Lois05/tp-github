<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bien;

class BienSeeder extends Seeder
{
    public function run()
    {
        Bien::factory()->count(20)->create();
    }
}
