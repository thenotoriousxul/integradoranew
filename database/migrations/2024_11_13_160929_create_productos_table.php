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
            $table->bigInteger('id', true);
            $table->string('tipo', 50);
            $table->enum('tamaño', ['CH', 'M', 'XL', 'XXL']);
            $table->string('color', 50);
            $table->integer('lote');
            $table->double('costo');
            $table->string('imagen_producto');
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
