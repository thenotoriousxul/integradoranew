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
        Schema::create('tipo_personas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('personas_id')->index('fk_tipo_personas_personas1');
            $table->enum('tipo_persona', ['Cliente', 'Empleado']);
            $table->string('curp', 50)->nullable();
            $table->string('rfc', 50)->nullable();
            $table->string('numero_ss', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_personas');
    }
};
