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
        Schema::create('edicion', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nombre_edicion', 50);
            $table->string('imagen_producto');
            $table->date('fecha_de_salida');
            $table->integer('lote')->default(0);
            $table->integer('existencias');
            $table->double('extra')->default(0);
            $table->double('costo_fabricacion')->default(0);
            $table->double('precio_de_venta')->default(0);
            $table->enum('tipo', ['Edicion', 'Personalizada']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edicion');
    }
};
