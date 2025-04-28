<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demande_conges', function (Blueprint $table) {
//       //       / Colonnes principales
                  $table->id();
                  $table->foreignId('idDemandeur')->constrained('p_utilisateur')->onDelete('cascade');
                  $table->foreignId('idApprobation')->nullable()->constrained('P_Approbation')->onDelete('set null');
                  $table->dateTime('dateDebut');
                  $table->dateTime('dateFin');
                  $table->decimal('nbrJours', 5, 2);
                  $table->text('note');
                  $table->dateTime('dateSoumission')->useCurrent();
                  $table->foreignId('idNiveauApprobation')->constrained('L_NiveauApprobation');
                  $table->foreignId('idEtatNiveauApprobation')->constrained('E_EtatNiveauApprobation');
                  $table->foreignId('idApprobateur')->nullable()->constrained('p_utilisateur')->onDelete('set null');

                  $table->timestamps();
    
         });
    }


    public function down()
    {
         Schema::dropIfExists('demande_conges');
    }
};