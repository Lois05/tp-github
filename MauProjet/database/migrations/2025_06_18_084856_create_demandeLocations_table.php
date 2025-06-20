<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandeLocations', function (Blueprint $table) {
            $table->id();
            $table->date(column:'dateDebut');
            $table->date(column:'dateFin');
            $table->string(column:'statut');
            $table->foreignId(column:'bien_id')->constrained(table:'biens');
            $table->foreignId(column:'locataire_id')->constrained(table:'locataires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_locations');
    }
};
