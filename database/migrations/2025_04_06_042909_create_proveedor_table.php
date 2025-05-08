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
    Schema::create('proveedores', function (Blueprint $table) {
        $table->id();
        $table->string('nombreProveedor', 45);
        $table->string('apellidoProveedor', 45);
        $table->string('compañía', 45);
        $table->integer('numeroProveedor');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
