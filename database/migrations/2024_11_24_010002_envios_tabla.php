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
    {Schema::create('envios', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('ordenes_id')->unique();
        $table->unsignedBigInteger('direcciones_id');
        $table->decimal('costo_envio', 10, 2);
        $table->enum('estado_envio', ['pendiente', 'entregado', 'cancelado']);
        $table->timestamp('fecha_envio')->nullable();
        $table->timestamp('fecha_entrega')->nullable();
        $table->timestamps();

        $table->foreign('ordenes_id')->references('id')->on('ordenes')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
