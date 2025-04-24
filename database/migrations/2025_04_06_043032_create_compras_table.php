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
    Schema::create('compras', function (Blueprint $table) {
        $table->id();
        $table->integer('ncompra');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('descuento', 10, 2);
        $table->decimal('iva', 10, 2);
        $table->decimal('total', 10, 2);
        $table->foreignId('tiempo_id')->constrained('tiempo');
        $table->foreignId('empleado_id')->constrained('empleados');
        $table->foreignId('proveedor_id')->constrained('proveedor');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
