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
        Schema::table('personas', function (Blueprint $table) {
            $table->foreign(['direcciones_id'], 'fk_personas_direcciones1')->references(['id'])->on('direcciones')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['users_id'], 'fk_personas_users1')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign('fk_personas_direcciones1');
            $table->dropForeign('fk_personas_users1');
        });
    }
};
