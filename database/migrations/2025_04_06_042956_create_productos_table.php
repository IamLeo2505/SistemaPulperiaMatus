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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('image_path', 100);
        $table->string('nombreProducto', 100);
        $table->string('descripcion', 255);
        $table->string('codigo_barras', 45);
        $table->integer('cantidadstock');
        $table->date('fechavencimiento');
        $table->decimal('precio_producto', 10, 2);
        $table->foreignId('unidad_medida_id')->constrained('unidades_medidas');
        $table->foreignId('categoria_id')->constrained('categorias');
        $table->foreignId('marca_id')->constrained('marcas');
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
