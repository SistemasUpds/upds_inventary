<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $table = "analisis";
    protected $primaryKey = "id";
    protected $fillable = ['centro_analisis'];

}
