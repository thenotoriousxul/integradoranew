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
        Schema::table('tipo_personas', function (Blueprint $table) {
            $table->foreign(['personas_id'], 'fk_tipo_personas_personas1')->references(['id'])->on('personas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_personas', function (Blueprint $table) {
            $table->dropForeign('fk_tipo_personas_personas1');
        });
    }
};
