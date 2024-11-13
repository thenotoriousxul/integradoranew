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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('nombre', 50);
            $table->string('numero_telefonico', 50);
            $table->bigInteger('direcciones_id')->index('fk_proveedores_direcciones1');
            $table->enum('tipo', ['Servicio', 'Materia Prima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
