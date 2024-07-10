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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('createur_id');
            $table->foreign('createur_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('administrateur_id')->nullable();
            $table->foreign('administrateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('projet_parent_id')->nullable();
            $table->foreign('projet_parent_id')->references('id')->on('projets')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->double('recette_actuelle')->default(0);
            $table->double('depense_actuelle')->default(0);
            $table->double('budget')->default(0);
            $table->date('date_fin');
            $table->string('image')->nullable();
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
