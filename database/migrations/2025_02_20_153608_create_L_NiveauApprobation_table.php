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
        if (!Schema::hasTable('L_NiveauApprobation')) {
            Schema::create('L_NiveauApprobation', function (Blueprint $table) {
            $table->id()->nullable();
            $table->foreignId('idApprobation')->constrained('P_Approbation');
            $table->string('libelle', 50);
            $table->string('couleur', 7); 
            $table->boolean('isInitialNode')->default(false);
            $table->boolean('isFinalNode')->default(false);
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('L_NiveauApprobation');
    }
};
