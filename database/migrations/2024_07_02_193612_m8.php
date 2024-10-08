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
        Schema::table('projets', function($table) {
            $table->timestamps();
        });
        Schema::table('transactions', function($table) {
            $table->timestamps();
        });
        Schema::table('depenses', function($table) {
            $table->timestamps();
        });
        Schema::table('articles', function($table) {
            $table->timestamps();
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
