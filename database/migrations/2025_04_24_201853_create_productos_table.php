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
        $table->string('descripcion', 255);
        $table->string('codigo_barras', 45);
        $table->string('marca', 45);
        $table->foreignId('unidad_medida_id')->constrained('unidad_medida');
        $table->foreignId('categoria_id')->constrained('categoria');
        $table->foreignId('proveedor_id')->constrained('proveedor');
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
