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
        Schema::create('p_utilisateur', function (Blueprint $table) {
            $table->id()->primary;
            $table->string('login')->unique();
            $table->string('username');
            $table->string('psw');// Mot de passe chiffré
            $table->string('mail');
            $table->string('nomPrenom'); 
            $table->string('tel')->nullable();
            $table->integer('soldeCongeInitial')->default(0);
            $table->String('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_utilisateur');
    }
};
