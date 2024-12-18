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
        $table->bigIncrements('id'); // Clave primaria como bigInteger UNSIGNED
        $table->bigInteger('edicion_id')->unsigned()->index('fk_table1_edicion');
        $table->bigInteger('productos_id')->unsigned()->index('fk_table1_productos1');
        $table->string('nombre', 50);
        $table->enum('talla', ['CH', 'M', 'XL', 'XXL']);
        $table->string('imagen_producto_final', 255);
        $table->string('imagen_producto_trasera', 255)->default('Personalizada');
        $table->decimal('costo_fabrica', 10, 2);
        $table->decimal('costo_precio_venta', 10, 2);
        $table->integer('cantidad')->default(0);
        $table->enum('estado',['activo','inactivo'])->default('activo');
        $table->boolean('personalizada')->default(false); 
        $table->boolean('rebaja')->default(false);
        $table->decimal('porcentaje_rebaja', 5,2)->default(0.00);
        $table->decimal('precio_rebajado', 10,2)->default(0.00);
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
