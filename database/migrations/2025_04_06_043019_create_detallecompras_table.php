<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('detalle_compras', function (Blueprint $table) {
    $table->id();
    $table->integer('cantidad');
    $table->decimal('precio_compra', 10, 2)->default(0);
    $table->decimal('subtotal', 10, 2)->default(0);
    $table->decimal('total', 10, 2)->default(0);
    $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade');

    $table->foreignId('producto_id')->constrained('productos');


    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
