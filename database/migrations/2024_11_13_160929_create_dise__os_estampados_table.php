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
        Schema::create('disenos_estampados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('estampado_id')->unsigned()->index('fk_disenos_estampados_estampados1'); // unsigned bigInteger
            $table->bigInteger('diseno_id')->unsigned()->index('fk_disenos_estampados_disenos1'); // unsigned bigInteger
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disenos_estampados');
    }
};
