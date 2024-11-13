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
        Schema::create('diseños_proveedores', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('diseños_id')->index('fk_diseños_proveedores_diseños1');
            $table->bigInteger('proveedores_id')->index('fk_diseños_proveedores_proveedores1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseños_proveedores');
    }
};
