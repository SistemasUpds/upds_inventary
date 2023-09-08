<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('codigo');
            $table->string('sigla');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tipos');
    }
};
