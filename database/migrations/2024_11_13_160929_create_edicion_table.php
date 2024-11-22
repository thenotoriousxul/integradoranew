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
            $table->bigIncrements('id');
            $table->string('nombre_edicion', 50);
            $table->string('descripcion', 255);
            $table->date('fecha_de_salida');
            $table->integer('lote')->default(0);
            $table->integer('existencias')->default(0);
            $table->decimal('extra', 10, 2)->default(0);
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
