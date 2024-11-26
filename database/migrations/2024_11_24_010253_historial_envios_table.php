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
        Schema::create('historial_envios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('envios_id')->unique(); 
            $table->enum('estado_envio', ['pendiente', 'entregado', 'cancelado']);
            $table->timestamp('fecha')->nullable();
            $table->timestamps();

            // Llave foránea
            $table->foreign('envios_id')->references('id')->on('envios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_envios');
    }
};
