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
        Schema::table('disenos_estampados', function (Blueprint $table) {
            $table->foreign(['diseno_id'], 'fk_disenos_estampados_disenos1')->references(['id'])->on('disenos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['estampado_id'], 'fk_disenos_estampados_estampados1')->references(['id'])->on('estampados')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disenos_estampados', function (Blueprint $table) {
            $table->dropForeign('fk_disenos_estampados_disenos1');
            $table->dropForeign('fk_disenos_estampados_estampados1');
        });
    }
};
