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
        Schema::create('demande_locations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('telephone');
            $table->text('message')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut', ['en_attente', 'acceptee', 'refusee'])->default('en_attente');

            // Définition explicite des colonnes en unsignedBigInteger
            $table->unsignedBigInteger('bien_id');
            $table->unsignedBigInteger('locataire_id');
            $table->unsignedBigInteger('proprietaire_id');
            $table->unsignedBigInteger('annonce_id');

            // Clés étrangères explicites
            $table->foreign('bien_id')->references('id')->on('biens')->onDelete('cascade');
            $table->foreign('locataire_id')->references('id')->on('locataires')->onDelete('cascade');
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires')->onDelete('cascade');
            $table->foreign('annonce_id')->references('id')->on('annonces')->onDelete('cascade');

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
