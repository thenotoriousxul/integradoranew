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
        Schema::create('diseños_estampados', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('estampados_id')->index('fk_diseños_estampados_estampados1');
            $table->bigInteger('diseños_id')->index('fk_diseños_estampados_diseños1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseños_estampados');
    }
};
