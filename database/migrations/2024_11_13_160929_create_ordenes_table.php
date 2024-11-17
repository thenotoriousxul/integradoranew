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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->bigIncrements('id'); // Clave primaria como unsigned bigInteger
            $table->bigInteger('tipo_personas_id')->unsigned()->index('fk_ordenes_tipo_personas1'); // unsigned bigInteger
            $table->date('fecha_orden');
            $table->decimal('total', 10, 2);
            $table->tinyInteger('envios_domicilio');
            $table->enum('estado', ['Pendiente', 'Entregada', 'Cancelada', 'Devuelta','Pagada']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
