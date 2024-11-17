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
        Schema::table('ediciones_estampados', function (Blueprint $table) {
            $table->foreign(['edicion_id'], 'fk_ediciones_estampados_edicion1')->references(['id'])->on('edicion')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['estampados_id'], 'fk_ediciones_estampados_estampados1')->references(['id'])->on('estampados')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ediciones_estampados', function (Blueprint $table) {
            $table->dropForeign('fk_ediciones_estampados_edicion1');
            $table->dropForeign('fk_ediciones_estampados_estampados1');
        });
    }
};
