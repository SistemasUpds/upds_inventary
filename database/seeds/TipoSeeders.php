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
        Tipo::create(['nombre' =>'Terreno', 'codigo' => '01', 'sigla' => 'TE']);
        Tipo::create(['nombre' =>'Edificaciones', 'codigo' => '02', 'sigla' => 'ED']);
        Tipo::create(['nombre' =>'Muebles y Enseres', 'codigo' => '03', 'sigla' => 'ME']);
        Tipo::create(['nombre' =>'Muebles y Enseres para educación', 'codigo' => '04', 'sigla' => 'MEE']);
        Tipo::create(['nombre' =>'Equipo de Computación' , 'codigo' => '05', 'sigla' => 'EC']);
        Tipo::create(['nombre' =>'Equipos academicos' , 'codigo' => '06', 'sigla' => 'EA']);
        Tipo::create(['nombre' =>'Equipo de seguridad y vigilancia' , 'codigo' => '07', 'sigla' => 'ESV']);
        Tipo::create(['nombre' =>'Otros equipos' , 'codigo' => '08', 'sigla' => 'AUT']);
        Tipo::create(['nombre' =>'Automotores' , 'codigo' => '09', 'sigla' => 'AUT']);
        Tipo::create(['nombre' =>'Biblioteca' , 'codigo' => '10', 'sigla' => 'AUT']);
        Tipo::create(['nombre' =>'Equipo (Maquinaria y equipo)' , 'codigo' => '11', 'sigla' => 'EQ']);
        Tipo::create(['nombre' =>'Instalaciones' , 'codigo' => '12', 'sigla' => 'INS']);
        Tipo::create(['nombre' =>'Bienes Arrendados' , 'codigo' => '13', 'sigla' => 'BA']);
        Tipo::create(['nombre' =>'Equipo de Computación para Educacion' , 'codigo' => '14', 'sigla' => 'ECE']);
        Tipo::create(['nombre' =>'Herramientas' , 'codigo' => '15', 'sigla' => 'HE']);
    }
}
