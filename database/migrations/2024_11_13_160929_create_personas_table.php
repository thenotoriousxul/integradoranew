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
        Schema::create('personas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->unsignedBigInteger('users_id')->index('fk_personas_users1');
            $table->bigInteger('direcciones_id')->index('fk_personas_direcciones1');
            $table->string('nombre', 50);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('fecha_nacimiento', 50);
            $table->enum('genero', ['M', 'F']);
            $table->string('numero_telefonico', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
