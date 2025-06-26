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
        Schema::create('proprietaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users');

            $table->enum('type', ['physique', 'moral']);

            // Propriétaire physique
            $table->date('date_naissance')->nullable();
            $table->string('npi')->nullable();

            // Propriétaire moral
            $table->string('raison_sociale')->nullable();
            $table->string('registre_commerce')->nullable();
            $table->string('representant_legal')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietaires');
    }
};
