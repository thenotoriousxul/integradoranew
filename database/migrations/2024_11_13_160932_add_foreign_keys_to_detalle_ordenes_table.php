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
        Schema::table('detalle_ordenes', function (Blueprint $table) {
            // Llave foránea hacia ediciones_productos
            $table->foreign('ediciones_productos_id', 'fk_detalle_ordenes_ediciones_productos1')
                  ->references('id')
                  ->on('ediciones_productos')
                  ->onUpdate('no action')
                  ->onDelete('no action');
    
            // Llave foránea hacia ordenes
            $table->foreign('ordenes_id', 'fk_detalle_ordenes_ordenes1')
                  ->references('id')
                  ->on('ordenes')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_ordenes', function (Blueprint $table) {
            $table->dropForeign('fk_detalle_ordenes_ediciones_productos1');
            $table->dropForeign('fk_detalle_ordenes_ordenes1');
        });
    }
};
