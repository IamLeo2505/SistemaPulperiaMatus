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
        Schema::create('precio_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->decimal('preciocompra', 10, 2);
            $table->decimal('precioventa', 10, 2);
            $table->decimal('impuesto_iva', 10, 2);
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
        Schema::dropIfExists('precio_producto');
    }
};
