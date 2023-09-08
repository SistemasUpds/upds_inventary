<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreasSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create(['nombre' =>'RECTORADO', 'sigla' => 'RE']);
        Area::create(['nombre' =>'SECRETARÍA RECTORADO', 'sigla' => 'SG']);
        Area::create(['nombre' =>'DIRECCION ADMINISTRATIVO FINANCIERA', 'sigla' => 'DAF']);
        Area::create(['nombre' =>'CONTABILIDAD PRUEBA', 'sigla' => 'CP']);
        Area::create(['nombre' =>'CONTABILIDAD FISCAL' , 'sigla' => 'CF']);
        Area::create(['nombre' =>'CAJAS' , 'sigla' => 'CJ']);
        Area::create(['nombre' =>'JEFATURA COMERCIAL' , 'sigla' => 'JC']);
        Area::create(['nombre' =>'SISTEMAS' , 'sigla' => 'SI']);
        Area::create(['nombre' =>'VICERRECTORADO ACADEMICO' , 'sigla' => 'VA']);
        Area::create(['nombre' =>'SECRETARIA VICERRECTORADO' , 'sigla' => 'SV']);
        Area::create(['nombre' =>'REGISTROS' , 'sigla' => 'RG']);
        Area::create(['nombre' =>'EXTENSION UNIVERSITARIA' , 'sigla' => 'EU']);
        Area::create(['nombre' =>'BIBLIOTECA' , 'sigla' => 'BI']);
        Area::create(['nombre' =>'COORDINADOR ADMINISTRACION DE EMPRESAS', 'sigla' => 'FCE']);
        Area::create(['nombre' =>'COORDINADOR INGENIERIA COMERCIAL', 'sigla' => 'FIC']);
        Area::create(['nombre' =>'COORDINADOR CONTADURIA PUBLICA', 'sigla' => 'FCP']);
        Area::create(['nombre' =>'COORDINADOR PSICOLOGIA - PSICOPEDAGOGIA', 'sigla' => 'FCS']);
        Area::create(['nombre' =>'COORDINADOR INGENIERIA CIVIL - SISTEMAS' , 'sigla' => 'FI']);
        Area::create(['nombre' =>'COORDINADOR DERECHO' , 'sigla' => 'FCJ']);
        Area::create(['nombre' =>'ASESORIA PEDAGOGICA' , 'sigla' => 'AP']);
        Area::create(['nombre' =>'INVESTIGACION' , 'sigla' => 'IN']);
        Area::create(['nombre' =>'LABORATORIO DE CIVIL' , 'sigla' => 'LC']);
        Area::create(['nombre' =>'LABORATORIO DE SISTEMAS' , 'sigla' => 'LS']);
        Area::create(['nombre' =>'DATA CENTER' , 'sigla' => 'DC']);
        Area::create(['nombre' =>'GABINETE PSICOPEDAGOGICO' , 'sigla' => 'GP']);
        Area::create(['nombre' =>'POST GRADO' , 'sigla' => 'PG']);
    
        Area::create(['nombre' =>'PLANIFICACION Y DESARROLLO INSTITUCIONAL' , 'sigla' => 'PDI']);
        Area::create(['nombre' =>'GESTION TALENTO HUMANO' , 'sigla' => 'GT']);
        Area::create(['nombre' =>'AULAS' , 'sigla' => 'AUL']);
        Area::create(['nombre' =>'AUDITORIUM' , 'sigla' => 'AD']);
        Area::create(['nombre' =>'PORTERIA Y SEGURIDAD' , 'sigla' => 'PS']);
        Area::create(['nombre' =>'PASILLOS' , 'sigla' => 'PAS']);
        Area::create(['nombre' =>'ALMACEN' , 'sigla' => 'ALM']);
        Area::create(['nombre' =>'CAFETERIA' , 'sigla' => 'CAF']);
    
    }
}
