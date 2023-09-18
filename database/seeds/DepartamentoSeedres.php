<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeedres extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create(['nombre' =>'Potosí', 'sigla' => 'PO']);
        Departamento::create(['nombre' =>'Sucre', 'sigla' => 'Su']);
        Departamento::create(['nombre' =>'Tarija', 'sigla' => 'TA']);
        Departamento::create(['nombre' =>'La Paz', 'sigla' => 'LP']);
        Departamento::create(['nombre' =>'Cochabamba', 'sigla' => 'CB']);
        Departamento::create(['nombre' =>'Oruro', 'sigla' => 'OR']);
        Departamento::create(['nombre' =>'Santa Cruz', 'sigla' => 'SC']);
    }
}
