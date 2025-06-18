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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->float(column:'note');
            $table->date(column:'date');
            $table->foreignId(column:'id_locataire')->constrained(table:'locataire')->onDelete(action:'cascade');
            $table->foreignId(column:'id_bien')->constrained(table:'biens')->onDelete(action:'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
