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
        Schema::create('portefeuilles', function (Blueprint $table) {
            $table->id();
            $table->float(column: 'solde');
            $table->string(column: 'devise', length:255);
            $table->foreignId(column:'locataire_id')->nullable()->constrained(table:'locataires');
            $table->foreignId(column:'proprietaire_id')->nullable()->constrained(table:'proprietaires');
            $table->foreignId(column:'admin_id')->nullable()->constrained(table:'admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portefeuilles');
    }
};
