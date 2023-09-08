<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('move_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('descripcion', 100)->nullable();
            $table->dateTime('movimiento')->nullable()->default(date('Y-m-d H:i:s'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('move_histories');
    }
};
