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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('localisation');
            $table->float('prix');
            $table->enum('statut', ['en_attente', 'validee', 'rejetee'])->default('en_attente');
            $table->foreignId('bien_id')->constrained('biens');
            $table->foreignId('proprietaire_id')->constrained('proprietaires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
