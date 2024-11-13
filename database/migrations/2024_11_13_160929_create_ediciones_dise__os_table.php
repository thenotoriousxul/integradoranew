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
        Schema::create('ediciones_diseños', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('edicion_id')->index('fk_ediciones_diseños_edicion1');
            $table->bigInteger('estampados_id')->index('fk_ediciones_diseños_estampados1');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_at', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones_diseños');
    }
};
