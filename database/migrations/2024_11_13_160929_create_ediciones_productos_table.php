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
        Schema::create('ediciones_productos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('edicion_id')->index('fk_table1_edicion');
            $table->bigInteger('productos_id')->index('fk_table1_productos1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones_productos');
    }
};
