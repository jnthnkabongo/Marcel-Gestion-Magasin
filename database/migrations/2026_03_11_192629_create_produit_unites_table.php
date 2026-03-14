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
        Schema::create('produit_unites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits');
            $table->string('numero_serie', 150)->unique();
            $table->string('quantite', 100);
            $table->enum('statut', ['en_stock', 'vendu', 'defectueux'])->default('en_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_unites');
    }
};
