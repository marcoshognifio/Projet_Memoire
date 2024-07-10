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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->string('type')->nullable();
            $table->unsignedBigInteger('projet_emetteur_id');
            $table->foreign('projet_emetteur_id')->references('id')->on('projets')->onDelete('cascade');
            $table->unsignedBigInteger('projet_destinataire_id');
            $table->foreign('projet_destinataire_id')->references('id')->on('projets')->onDelete('cascade');
            $table->string('objet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
