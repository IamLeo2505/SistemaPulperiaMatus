<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Eliminar la clave foránea existente
            $table->dropForeign(['empleado_id']);
            // Añadir la nueva clave foránea con onDelete('cascade')
            $table->foreign('empleado_id')
                  ->references('id')
                  ->on('empleados')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Revertir: eliminar la clave foránea con cascade
            $table->dropForeign(['empleado_id']);
            // Restaurar la clave foránea original (sin cascade)
            $table->foreign('empleado_id')
                  ->references('id')
                  ->on('empleados');
        });
    }
};