<?php

use App\Observacion;
use Illuminate\Database\Seeder;

class ObservacionSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Observacion::create(['observacion' =>'Termino su Vida Util']);
        Observacion::create(['observacion' =>'Porque esta roto']);
        Observacion::create(['observacion' =>'Por Viejo']);
        Observacion::create(['observacion' =>'Desechado']);
    }
}
