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
        Schema::create('pago', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('ordenes_id')->index('fk_pago_ordenes1');
            $table->double('descuento')->nullable()->default(0);
            $table->double('pago_total');
            $table->enum('metodo_pago', ['Efectivo', 'Tarjeta', 'Transferencia']);
            $table->date('fecha_pago');
            $table->enum('estado', ['Pagado', 'Pendiente', 'Rechazado']);
            $table->string('num_referencia', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
