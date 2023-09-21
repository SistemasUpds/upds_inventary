<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtroMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otro_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->integer('estado')->default(1);
            $table->string('image')->nullable();
            $table->text('descripcion', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otro_materials');
    }
}
