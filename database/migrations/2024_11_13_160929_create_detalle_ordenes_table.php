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
    Schema::create('detalle_ordenes', function (Blueprint $table) {
        $table->bigIncrements('id'); // Clave primaria
        $table->bigInteger('ediciones_productos_id')->unsigned()->index('fk_detalle_ordenes_ediciones_productos1');
        $table->bigInteger('ordenes_id')->unsigned()->index('fk_detalle_ordenes_ordenes1');
        $table->integer('cantidad');
        $table->decimal('total', 10, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ordenes');
    }
};
