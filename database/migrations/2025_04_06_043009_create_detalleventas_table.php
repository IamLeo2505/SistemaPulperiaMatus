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
    Schema::create('detalle_ventas', function (Blueprint $table) {
        $table->id();
        $table->integer('cantidad');
        $table->decimal('precio', 10, 2);
        $table->decimal('descuento', 10, 2);
        $table->decimal('subtotal', 10, 2);
        $table->decimal('total', 10, 2);
        $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
        $table->foreignId('producto_id')->constrained('productos');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventas');
    }
};
