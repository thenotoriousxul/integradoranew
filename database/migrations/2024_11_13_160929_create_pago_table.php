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
            $table->bigIncrements('id');
            $table->bigInteger('ordenes_id')->unsigned()->index('fk_pago_ordenes1'); // unsigned bigInteger
            $table->decimal('descuento', 10, 2)->nullable()->default(0);
            $table->decimal('pago_total', 10, 2);
            $table->enum('metodo_pago', ['Efectivo', 'Tarjeta']);
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
