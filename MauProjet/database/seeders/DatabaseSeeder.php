<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run():void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            LocataireSeeder::class,
            ProprietaireSeeder::class,
            CategorieSeeder::class,
            BienSeeder::class,
            AnnonceSeeder::class,
            AvisSeeder::class,
            DemandeLocationSeeder::class,
            PaiementSeeder::class,
            PortefeuilleSeeder::class,
            SignalementSeeder::class,
        ]);
    }
}
