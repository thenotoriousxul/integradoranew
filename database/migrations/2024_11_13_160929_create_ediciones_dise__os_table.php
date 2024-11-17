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
        Schema::create('ediciones_estampados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('edicion_id')->unsigned()->index('fk_ediciones_estampados_edicion1'); // unsigned bigInteger
            $table->bigInteger('estampados_id')->unsigned()->index('fk_ediciones_estampados_estampados1'); // unsigned bigInteger
            $table->timestamp('created_at')->nullable();
            $table->string('updated_at', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones_estampados');
    }
};
