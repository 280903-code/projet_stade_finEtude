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
        Schema::create('terrains', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email');
            $table->string('image')->nullable();
            $table->decimal('prix_matin', 10, 2)->default(10000);
            $table->decimal('prix_apres_midi', 10, 2)->default(15000);
            $table->decimal('prix_soir', 10, 2)->default(20000);
            $table->time('horaire_ouverture')->default('08:00:00');
            $table->time('horaire_fermeture')->default('22:00:00');
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terrains');
    }
};
