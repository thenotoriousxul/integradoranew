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
        Schema::table('disenos_proveedores', function (Blueprint $table) {
            $table->foreign(['disenos_id'], 'fk_disenos_proveedores_disenos1')->references(['id'])->on('disenos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['proveedores_id'], 'fk_disenos_proveedores_proveedores1')->references(['id'])->on('proveedores')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disenos_proveedores', function (Blueprint $table) {
            $table->dropForeign('fk_disenos_proveedores_disenos1');
            $table->dropForeign('fk_disenos_proveedores_proveedores1');
        });
    }
};
