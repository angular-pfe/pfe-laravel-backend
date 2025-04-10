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
        Schema::create('E_EtatNiveauApprobation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idNiveauApprobation');
            $table->foreign('idNiveauApprobation')->references('id')->on('L_NiveauApprobation');
            $table->string('libelle', 50);
            $table->string('couleur', 7); 
            $table->boolean('isValidation')->default(false);
            $table->integer('passageNiveau')->default(1);
            $table->boolean('isDefault')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('E_EtatNiveauApprobation');
    }
};
