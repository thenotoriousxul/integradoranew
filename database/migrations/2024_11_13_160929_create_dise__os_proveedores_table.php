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
        Schema::create('disenos_proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('disenos_id')->unsigned()->index('fk_disenos_proveedores_disenos1'); // unsigned bigInteger
            $table->bigInteger('proveedores_id')->unsigned()->index('fk_disenos_proveedores_proveedores1'); // unsigned bigInteger
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disenos_proveedores');
    }
};
