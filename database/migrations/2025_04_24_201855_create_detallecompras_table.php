<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('detalle_compras', function (Blueprint $table) {
        $table->id();
        $table->integer('cantidad');
        $table->decimal('precio', 10, 2);
        $table->decimal('iva', 10, 2);
        $table->decimal('descuento', 10, 2);
        $table->decimal('subtotal', 10, 2);
        $table->decimal('total', 10, 2);
        $table->foreignId('compra_id')->constrained('compras');
        $table->foreignId('producto_id')->constrained('productos');
        $table->foreignId('unidad_medida_id')->constrained('unidad_medida');
        $table->foreignId('categoria_id')->constrained('categoria');
        $table->foreignId('inventario_id')->constrained('inventario');
        $table->foreignId('proveedor_id')->constrained('proveedor');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallecompras');
    }
};
