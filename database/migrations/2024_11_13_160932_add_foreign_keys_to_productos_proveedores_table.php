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
        Schema::table('productos_proveedores', function (Blueprint $table) {
            $table->foreign(['productos_id'], 'fk_productos_proveedores_productos1')->references(['id'])->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['proveedores_id'], 'fk_productos_proveedores_proveedores1')->references(['id'])->on('proveedores')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos_proveedores', function (Blueprint $table) {
            $table->dropForeign('fk_productos_proveedores_productos1');
            $table->dropForeign('fk_productos_proveedores_proveedores1');
        });
    }
};
