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
            $table->id();
           
            $table->foreignId('idNiveauApprobation')->constrained('L_NiveauApprobation')->nullable();

            $table->string('libelle', 50)->unique();
            $table->string('couleur', 7)->default('#000000'); 
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
