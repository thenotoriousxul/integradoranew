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
        Schema::create('detalle_ordenes', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('edicion_id')->index('fk_detalle_ordenes_edicion1');
            $table->bigInteger('ordenes_id')->index('fk_detalle_ordenes_ordenes1');
            $table->integer('cantidad');
            $table->double('precio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ordenes');
    }
};
