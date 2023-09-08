<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('activo_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->unsignedBigInteger('centro_id')->nullable();
            $table->unsignedBigInteger('obserb_id')->nullable();
            $table->string('novus', 200);
            $table->integer('estado')->default(1);
            $table->text('razon')->nullable();
            $table->string('image')->nullable();
            $table->String('qr_code')->nullable();
            $table->String('codigo', 50);
            $table->text('descripcion', 50)->nullable();
            $table->date('fecha_compra');
            $table->dateTime('fecha_baja')->nullable();
            $table->string('user_baja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};

/*
ahora quiero sacar de este nombre $coll->nombre = $request->nombre INSTITUCION
 UNIDAD
 RECTORADO, 
 SECRETARÍA RECTORADO
 DIRECCION ADMINISTRATIVO FINANCIERA,
 CONTABILIDAD PRUEBA,
 CONTABILIDAD FISCAL,
 CAJAS,
 JEFATURA COMERCIAL,
 SISTEMAS,
 VICERRECTORADO ACADEMICO,
 SECRETARIA VICERRECTORADO,
 REGISTROS,
 EXTENSION UNIVERSITARIA,
 BIBLIOTECA,
 COORDINADOR ADMINISTRACION DE EMPRESAS,
 COORDINADOR INGENIERIA COMERCIAL,
 COORDINADOR CONTADURIA PUBLICA,
 COORDINADOR PSICOLOGIA - PSICOPEDAGOGIA,
 COORDINADOR INGENIERIA CIVIL - SISTEMAS,
 COORDINADOR DERECHO,
 ASESORIA PEDAGOGICA,
 INVESTIGACION,
 LABORATORIO DE CIVIL,
 LABORATORIO DE SISTEMAS,
 DATA CENTER,
 GABINETE PSICOPEDAGOGICO,
 POST GRADO,
 PLANIFICACION Y DESARROLLO INSTITUCIONAL,
 GESTION TALENTO HUMANO
 CODIGO 
 RE 
 SG
 DAF
 CP
 CF
 CJ
 JC
 S
 VA
 SV
 RG
 EU
 BI
 FCE
 FIC
 CCP
 CPP
 CD
 AP
 INV
 LC
 LS
 DC
 GP
 PG
 PDI
 GT
 */