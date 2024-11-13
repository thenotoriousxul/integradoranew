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
        Schema::table('ediciones_productos', function (Blueprint $table) {
            $table->foreign(['edicion_id'], 'fk_table1_edicion')->references(['id'])->on('edicion')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['productos_id'], 'fk_table1_productos1')->references(['id'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ediciones_productos', function (Blueprint $table) {
            $table->dropForeign('fk_table1_edicion');
            $table->dropForeign('fk_table1_productos1');
        });
    }
};
