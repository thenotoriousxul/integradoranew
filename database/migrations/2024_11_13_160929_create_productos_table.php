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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo', 50);
            $table->enum('talla', ['CH', 'M', 'XL', 'XXL']);
            $table->string('color', 50);
            $table->decimal('costo', 10, 2);
            $table->integer('lote');
            $table->string('imagen_producto');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo'); // Define la columna 'estado'
            $table->boolean('producto_personalizar')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
