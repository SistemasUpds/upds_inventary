<?php

use App\Analisis;
use Illuminate\Database\Seeder;

class AnalisiSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Analisis::create(['centro_analisis' =>'Rectorado Regional']);
        Analisis::create(['centro_analisis' =>'Vicerrectorado']);
        Analisis::create(['centro_analisis' =>'Dirección Administrativa']);
        Analisis::create(['centro_analisis' =>'Secretaria General']);
        Analisis::create(['centro_analisis' =>'Comercial Pregrado']);
        Analisis::create(['centro_analisis' =>'Comercial Postgrado']);
    }
}
