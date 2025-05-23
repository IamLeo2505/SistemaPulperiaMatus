<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmpleadosSeeder::class,
            UsuariosSeeder::class,
            MarcasSeeder::class,
            ProveedorSeeder::class,
            ClientesSeeder::class,
            VentasSeeder::class,
            CategoriaSeeder::class,
            UnidadMedidaSeeder::class,
            ComprasSeeder::class,
            ProductosSeeder::class,
            DetalleVentasSeeder::class,
            DetalleComprasSeeder::class,
            TiempoSeeder::class,
        ]);
    }
}
