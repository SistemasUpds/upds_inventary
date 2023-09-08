<?php

use App\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permiso::create([
            'user_id' => 1,
            'dar_baja_item' => true,
            'crear_user' => true,
            'exportar' => true,
            'editar_area' => true,
            'borrar_area' => true,
        ]);
        Permiso::create([
            'user_id' => 2,
            'dar_baja_item' => true,
            'crear_user' => false,
            'exportar' => true,
            'editar_area' => true,
            'borrar_area' => true,
        ]);
        Permiso::create([
            'user_id' => 3,
            'dar_baja_item' => false,
            'crear_user' => false,
            'exportar' => false,
            'editar_area' => true,
            'borrar_area' => true,
        ]);
    }
}
