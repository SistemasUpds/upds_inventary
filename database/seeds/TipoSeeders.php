<?php

use App\Tipo;
use Illuminate\Database\Seeder;

class TipoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['nombre' =>'Terreno', 'codigo' => '1.1', 'sigla' => 'TE']);
        Tipo::create(['nombre' =>'Edificaciones', 'codigo' => '2.1', 'sigla' => 'ED']);
        Tipo::create(['nombre' =>'Muebles y Enseres', 'codigo' => '3.1', 'sigla' => 'ME']);
        Tipo::create(['nombre' =>'Muebles y Enseres para educación', 'codigo' => '3.2', 'sigla' => 'MEE']);
        Tipo::create(['nombre' =>'Equipo (Maquinaria y equipo)' , 'codigo' => '4.1', 'sigla' => 'EQ']);
        Tipo::create(['nombre' =>'Equipos academicos' , 'codigo' => '4.2', 'sigla' => 'EA']);
        Tipo::create(['nombre' =>'Instalaciones' , 'codigo' => '4.3', 'sigla' => 'INS']);
        Tipo::create(['nombre' =>'Bienes Arrendados' , 'codigo' => '4.4', 'sigla' => 'BA']);
        Tipo::create(['nombre' =>'Equipo de Computación' , 'codigo' => '5.1', 'sigla' => 'EC']);
        Tipo::create(['nombre' =>'Equipo de Computación para Educacion' , 'codigo' => '5.2', 'sigla' => 'ECE']);
        Tipo::create(['nombre' =>'Equipo de seguridad y vigilancia' , 'codigo' => '5.3', 'sigla' => 'ESV']);
        Tipo::create(['nombre' =>'Automotores' , 'codigo' => '6.1', 'sigla' => 'AUT']);
        Tipo::create(['nombre' =>'Herramientas' , 'codigo' => '7.1', 'sigla' => 'HE']);
    }
}
