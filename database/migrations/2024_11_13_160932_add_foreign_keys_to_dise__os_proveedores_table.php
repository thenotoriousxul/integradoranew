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
        Schema::table('diseños_proveedores', function (Blueprint $table) {
            $table->foreign(['diseños_id'], 'fk_diseños_proveedores_diseños1')->references(['id'])->on('diseños')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['proveedores_id'], 'fk_diseños_proveedores_proveedores1')->references(['id'])->on('proveedores')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diseños_proveedores', function (Blueprint $table) {
            $table->dropForeign('fk_diseños_proveedores_diseños1');
            $table->dropForeign('fk_diseños_proveedores_proveedores1');
        });
    }
};
