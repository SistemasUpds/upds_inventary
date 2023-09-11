<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['estado' =>'Nuevo']);
        Estado::create(['estado' =>'Regular']);
        Estado::create(['estado' =>'Viejo']);
    }
}
