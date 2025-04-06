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
    Schema::create('empleados', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 45);
        $table->string('apellido', 45);
        $table->string('telefono', 45);
        $table->string('direccion', 255);
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
